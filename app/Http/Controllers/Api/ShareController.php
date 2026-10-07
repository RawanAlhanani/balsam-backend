<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

/**
 * Link previews for the React SPA.
 *
 * Social crawlers (WhatsApp, Facebook, Telegram...) don't run JavaScript, so
 * the SPA cannot give them a title/image. The frontend's .htaccess redirects
 * only those crawlers here: page() returns minimal HTML carrying the Open
 * Graph tags, and image() builds the branded 1200x630 preview picture.
 */
class ShareController extends Controller
{
    private const W = 1200;
    private const H = 630;
    private const TEAL = [13, 83, 119];
    private const TEAL_LIGHT = [27, 127, 168];

    public function page($type, $id)
    {
        try {
            $item = $this->resolve($type, (int) $id);
            if (!$item) {
                return response('Not found', 404)->header('Content-Type', 'text/plain; charset=utf-8');
            }

            $html = view('share', [
                'title' => $item['title'],
                'description' => $item['description'],
                'canonical' => $this->frontendUrl() . $item['path'],
                'image' => url("/api/share/{$type}/{$id}/image.jpg"),
                'published' => $item['published'],
            ])->render();

            return response($html, 200)->header('Content-Type', 'text/html; charset=utf-8');
        } catch (\Exception $e) {
            Log::error('Share page error', ['type' => $type, 'id' => $id, 'error' => $e->getMessage()]);
            return response('Error', 500)->header('Content-Type', 'text/plain; charset=utf-8');
        }
    }

    public function image($type, $id)
    {
        $item = $this->resolve($type, (int) $id);
        $source = $item ? $this->sourcePath($item['image']) : null;
        return $this->serveCard("{$type}-{$id}", $source);
    }

    public function defaultImage()
    {
        return $this->serveCard('default', null);
    }

    private function frontendUrl()
    {
        return rtrim(env('FRONTEND_URL') ?: 'https://balsam.ma', '/');
    }

    // Public content only; returns null when the item doesn't exist.
    private function resolve($type, $id)
    {
        switch ($type) {
            case 'news':
                $m = \App\Info::find($id);
                return $m ? [
                    'title' => $m->titre,
                    'description' => $this->excerpt($m->description),
                    'image' => $m->image_info,
                    'path' => "/Information/{$id}",
                    'published' => $m->created_at,
                ] : null;

            case 'activity':
                $m = \App\Activite::find($id);
                return $m ? [
                    'title' => $m->titre,
                    'description' => $this->excerpt('📅 ' . $m->date_activite . ' — ' . $m->description),
                    'image' => $m->image_activite,
                    'path' => "/uneActivite/{$id}",
                    'published' => $m->created_at,
                ] : null;

            case 'project':
                $m = \App\Projet::find($id);
                return $m ? [
                    'title' => $m->titre,
                    'description' => $this->excerpt($m->description ?: $this->structuredText($m->structured_description)),
                    'image' => $m->projet_image,
                    'path' => "/projet/{$id}",
                    'published' => $m->created_at,
                ] : null;

            case 'autism':
                $m = \App\PageAutisme::find($id);
                return $m ? [
                    'title' => $m->titre,
                    'description' => $this->excerpt($m->description ?: $this->structuredText($m->structured_description)),
                    'image' => $m->page_image,
                    'path' => "/page_autisme/{$id}",
                    'published' => $m->created_at,
                ] : null;
        }

        return null;
    }

    // First readable text of a block-editor page ({sections:[{type, content|items}]}).
    private function structuredText($structured)
    {
        $sections = is_array($structured) ? ($structured['sections'] ?? []) : [];
        foreach ($sections as $section) {
            if (($section['type'] ?? '') === 'paragraph' && !empty($section['content'])) {
                return $section['content'];
            }
            if (($section['type'] ?? '') === 'list' && !empty($section['items'])) {
                return implode('، ', array_filter((array) $section['items']));
            }
        }
        return '';
    }

    private function excerpt($text, $limit = 200)
    {
        $text = html_entity_decode(strip_tags((string) $text), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $text = trim(preg_replace('/\s+/u', ' ', $text));
        if (mb_strlen($text) > $limit) {
            $text = rtrim(mb_substr($text, 0, $limit - 1)) . '…';
        }
        return $text;
    }

    private function sourcePath($name)
    {
        if (!$name) {
            return null;
        }
        $name = basename($name);
        foreach ([storage_path('app/public/MesImages/' . $name), public_path('ImagesActivites/' . $name)] as $path) {
            if (is_file($path)) {
                return $path;
            }
        }
        return null;
    }

    // Serves the cached card, building it first when the photo is new or changed.
    private function serveCard($key, $source)
    {
        $headers = ['Content-Type' => 'image/jpeg', 'Cache-Control' => 'public, max-age=86400'];
        $dir = storage_path('app/og-cache');
        $file = $dir . '/' . $key . '-' . ($source ? md5($source . filemtime($source)) : 'brand') . '.jpg';

        try {
            if (!is_file($file)) {
                if (!is_dir($dir)) {
                    @mkdir($dir, 0775, true);
                }
                if (!$this->renderCard($file, $source)) {
                    throw new \RuntimeException('GD unavailable or image unreadable');
                }
                // Drop stale versions of this card (the photo was replaced).
                foreach (glob($dir . '/' . $key . '-*.jpg') ?: [] as $old) {
                    if ($old !== $file) {
                        @unlink($old);
                    }
                }
            }
            return response()->file($file, $headers);
        } catch (\Throwable $e) {
            Log::warning('Share image fallback', ['key' => $key, 'error' => $e->getMessage()]);
            // Never leave the preview empty: original photo, else the plain logo.
            if ($source) {
                return response()->file($source);
            }
            return response()->file(resource_path('og/logo.png'), ['Content-Type' => 'image/png']);
        }
    }

    private function renderCard($file, $source)
    {
        if (!function_exists('imagecreatetruecolor')) {
            return false;
        }
        @ini_set('memory_limit', '256M');

        $canvas = imagecreatetruecolor(self::W, self::H);
        imagealphablending($canvas, true);
        $photo = $source ? $this->loadImage($source) : null;

        if ($photo) {
            $sw = imagesx($photo);
            $sh = imagesy($photo);
            $scale = max(self::W / $sw, self::H / $sh);
            $cw = self::W / $scale;
            $ch = self::H / $scale;
            // Bias the crop upward a little: faces sit in the upper part of photos.
            imagecopyresampled($canvas, $photo, 0, 0, (int) (($sw - $cw) / 2), (int) (($sh - $ch) * 0.35), self::W, self::H, (int) $cw, (int) $ch);
            imagedestroy($photo);
            $this->bottomGradient($canvas);
            $this->logoPill($canvas, 260, 22, self::W - 40, 40, true);
        } else {
            $this->brandBackground($canvas);
            $this->logoPill($canvas, 560, 50, (int) ((self::W - 660) / 2), (int) ((self::H - 318) / 2), false);
        }

        // Accent bar along the bottom edge.
        imagefilledrectangle($canvas, 0, self::H - 10, self::W, self::H, imagecolorallocate($canvas, ...self::TEAL_LIGHT));

        $ok = imagejpeg($canvas, $file, 84);
        imagedestroy($canvas);
        return $ok;
    }

    private function loadImage($path)
    {
        $info = @getimagesize($path);
        if (!$info) {
            return null;
        }
        switch ($info[2]) {
            case IMAGETYPE_JPEG:
                $im = @imagecreatefromjpeg($path);
                // Phone photos are often stored rotated with an EXIF flag that
                // browsers honour but GD ignores.
                if ($im && function_exists('exif_read_data')) {
                    $exif = @exif_read_data($path);
                    $angle = [3 => 180, 6 => -90, 8 => 90][$exif['Orientation'] ?? 1] ?? 0;
                    if ($angle) {
                        $im = imagerotate($im, $angle, 0);
                    }
                }
                return $im ?: null;
            case IMAGETYPE_PNG:
                return @imagecreatefrompng($path) ?: null;
            case IMAGETYPE_GIF:
                return @imagecreatefromgif($path) ?: null;
            case IMAGETYPE_WEBP:
                return function_exists('imagecreatefromwebp') ? (@imagecreatefromwebp($path) ?: null) : null;
        }
        return null;
    }

    private function bottomGradient($im)
    {
        $height = 240;
        for ($i = 0; $i < $height; $i++) {
            // 127 = fully transparent, ~35 = mostly opaque teal at the very bottom.
            $alpha = (int) (127 - 92 * ($i / $height) ** 1.6);
            imageline($im, 0, self::H - $height + $i, self::W, self::H - $height + $i, imagecolorallocatealpha($im, ...array_merge(self::TEAL, [$alpha])));
        }
    }

    private function brandBackground($im)
    {
        for ($y = 0; $y < self::H; $y++) {
            $t = $y / self::H;
            $c = [];
            foreach ([0, 1, 2] as $k) {
                $c[$k] = (int) (self::TEAL[$k] + (self::TEAL_LIGHT[$k] - self::TEAL[$k]) * $t);
            }
            imageline($im, 0, $y, self::W, $y, imagecolorallocate($im, ...$c));
        }
        // Soft translucent circles for depth.
        foreach ([[1050, 90, 420, 112], [150, 560, 360, 114], [980, 600, 220, 110]] as [$cx, $cy, $d, $a]) {
            imagefilledellipse($im, $cx, $cy, $d, $d, imagecolorallocatealpha($im, 255, 255, 255, $a));
        }
    }

    // White rounded badge holding the logo. $x is the right edge when $rightAligned.
    private function logoPill($im, $logoWidth, $pad, $x, $y, $rightAligned)
    {
        $logo = @imagecreatefrompng(resource_path('og/logo.png'));
        if (!$logo) {
            return;
        }
        $logoHeight = (int) round(imagesy($logo) * $logoWidth / imagesx($logo));
        $w = $logoWidth + $pad * 2;
        $h = $logoHeight + $pad * 2;
        $x1 = $rightAligned ? $x - $w : $x;
        $white = imagecolorallocate($im, 255, 255, 255);
        $r = (int) ($h / 4);

        imagefilledrectangle($im, $x1 + $r, $y, $x1 + $w - $r, $y + $h, $white);
        imagefilledrectangle($im, $x1, $y + $r, $x1 + $w, $y + $h - $r, $white);
        foreach ([[$x1 + $r, $y + $r], [$x1 + $w - $r, $y + $r], [$x1 + $r, $y + $h - $r], [$x1 + $w - $r, $y + $h - $r]] as [$cx, $cy]) {
            imagefilledellipse($im, $cx, $cy, $r * 2, $r * 2, $white);
        }
        imagecopyresampled($im, $logo, $x1 + $pad, $y + $pad, 0, 0, $logoWidth, $logoHeight, imagesx($logo), imagesy($logo));
        imagedestroy($logo);
    }
}
