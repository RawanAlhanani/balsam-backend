<?php

namespace App\Support;

/**
 * dompdf does not perform Arabic contextual letter shaping (no complex text
 * layout engine) - it renders every character in its isolated form, so
 * Arabic text comes out as disconnected letters instead of joined script.
 * This reshapes a string into the correct Unicode Arabic Presentation Forms
 * codepoints (isolated/initial/medial/final) *before* handing it to dompdf,
 * so no shaping is needed at render time. Reading order is left untouched -
 * dompdf's own bidi handling already displays the result correctly RTL.
 */
class ArabicShaper
{
    // [isolated, initial, medial, final] presentation-form codepoints.
    // Letters with only 2 entries are "right-joining only" (connect from a
    // preceding letter but never extend a connection to the following one).
    private static $forms = [
        0x0621 => [0xFE80],                                 // hamza
        0x0622 => [0xFE81, null, null, 0xFE82],             // alef with madda above
        0x0623 => [0xFE83, null, null, 0xFE84],             // alef with hamza above
        0x0624 => [0xFE85, null, null, 0xFE86],             // waw with hamza above
        0x0625 => [0xFE87, null, null, 0xFE88],             // alef with hamza below
        0x0626 => [0xFE89, 0xFE8B, 0xFE8C, 0xFE8A],         // yeh with hamza above
        0x0627 => [0xFE8D, null, null, 0xFE8E],             // alef
        0x0628 => [0xFE8F, 0xFE91, 0xFE92, 0xFE90],         // beh
        0x0629 => [0xFE93, null, null, 0xFE94],             // teh marbuta
        0x062A => [0xFE95, 0xFE97, 0xFE98, 0xFE96],         // teh
        0x062B => [0xFE99, 0xFE9B, 0xFE9C, 0xFE9A],         // theh
        0x062C => [0xFE9D, 0xFE9F, 0xFEA0, 0xFE9E],         // jeem
        0x062D => [0xFEA1, 0xFEA3, 0xFEA4, 0xFEA2],         // hah
        0x062E => [0xFEA5, 0xFEA7, 0xFEA8, 0xFEA6],         // khah
        0x062F => [0xFEA9, null, null, 0xFEAA],             // dal
        0x0630 => [0xFEAB, null, null, 0xFEAC],             // thal
        0x0631 => [0xFEAD, null, null, 0xFEAE],             // reh
        0x0632 => [0xFEAF, null, null, 0xFEB0],             // zain
        0x0633 => [0xFEB1, 0xFEB3, 0xFEB4, 0xFEB2],         // seen
        0x0634 => [0xFEB5, 0xFEB7, 0xFEB8, 0xFEB6],         // sheen
        0x0635 => [0xFEB9, 0xFEBB, 0xFEBC, 0xFEBA],         // sad
        0x0636 => [0xFEBD, 0xFEBF, 0xFEC0, 0xFEBE],         // dad
        0x0637 => [0xFEC1, 0xFEC3, 0xFEC4, 0xFEC2],         // tah
        0x0638 => [0xFEC5, 0xFEC7, 0xFEC8, 0xFEC6],         // zah
        0x0639 => [0xFEC9, 0xFECB, 0xFECC, 0xFECA],         // ain
        0x063A => [0xFECD, 0xFECF, 0xFED0, 0xFECE],         // ghain
        0x0641 => [0xFED1, 0xFED3, 0xFED4, 0xFED2],         // feh
        0x0642 => [0xFED5, 0xFED7, 0xFED8, 0xFED6],         // qaf
        0x0643 => [0xFED9, 0xFEDB, 0xFEDC, 0xFEDA],         // kaf
        0x0644 => [0xFEDD, 0xFEDF, 0xFEE0, 0xFEDE],         // lam
        0x0645 => [0xFEE1, 0xFEE3, 0xFEE4, 0xFEE2],         // meem
        0x0646 => [0xFEE5, 0xFEE7, 0xFEE8, 0xFEE6],         // noon
        0x0647 => [0xFEE9, 0xFEEB, 0xFEEC, 0xFEEA],         // heh
        0x0648 => [0xFEED, null, null, 0xFEEE],             // waw
        0x0649 => [0xFEEF, null, null, 0xFEF0],             // alef maksura
        0x064A => [0xFEF1, 0xFEF3, 0xFEF4, 0xFEF2],         // yeh
    ];

    // Lam-alef ligatures: [isolated, final] keyed by the alef variant codepoint.
    private static $lamAlef = [
        0x0622 => [0xFEF5, 0xFEF6],
        0x0623 => [0xFEF7, 0xFEF8],
        0x0625 => [0xFEF9, 0xFEFA],
        0x0627 => [0xFEFB, 0xFEFC],
    ];

    private static $lam = 0x0644;

    public static function reshape(string $text): string
    {
        $chars = preg_split('//u', $text, -1, PREG_SPLIT_NO_EMPTY);
        if ($chars === false) return $text;

        $codepoints = array_map(function ($c) {
            $cp = mb_ord($c, 'UTF-8');
            return $cp === false ? null : $cp;
        }, $chars);

        $n = count($codepoints);
        $out = '';
        $i = 0;

        while ($i < $n) {
            $cp = $codepoints[$i];

            // Lam-alef ligature: consume both codepoints as one unit.
            if ($cp === self::$lam && $i + 1 < $n && isset(self::$lamAlef[$codepoints[$i + 1]])) {
                $connectsPrev = self::joinsNext($codepoints[$i - 1] ?? null);
                [$isolated, $final] = self::$lamAlef[$codepoints[$i + 1]];
                $out .= self::toUtf8($connectsPrev ? $final : $isolated);
                $i += 2;
                continue;
            }

            if (!isset(self::$forms[$cp])) {
                $out .= $chars[$i];
                $i++;
                continue;
            }

            $form = self::$forms[$cp];
            $isDual = count($form) === 4;

            $connectsPrev = self::joinsNext($codepoints[$i - 1] ?? null);
            $connectsNext = $isDual && self::joinsPrev($codepoints[$i + 1] ?? null);

            // A neighbor extending a connection doesn't guarantee THIS
            // letter's form table has that slot - hamza, for instance, is
            // isolated-only ([0xFE80]) even though a dual-joining letter
            // right before it (e.g. "بأ") reports connectsPrev = true.
            // Fall back to the isolated form whenever the specific slot is
            // missing instead of indexing straight into it.
            if ($connectsPrev && $connectsNext && isset($form[2])) {
                $glyph = $form[2]; // medial
            } elseif ($connectsPrev && isset($form[3])) {
                $glyph = $form[3]; // final
            } elseif ($connectsNext && isset($form[1])) {
                $glyph = $form[1]; // initial
            } else {
                $glyph = $form[0]; // isolated
            }

            $out .= self::toUtf8($glyph ?? $form[0]);
            $i++;
        }

        return $out;
    }

    // Does this letter extend a connection to the NEXT letter (i.e. can the
    // following letter attach to it)? Only dual-joining letters do.
    private static function joinsNext($cp): bool
    {
        if ($cp === null || !isset(self::$forms[$cp])) return false;
        return count(self::$forms[$cp]) === 4;
    }

    // Does this letter accept a connection FROM the previous letter? Every
    // shaped Arabic letter (dual or right-joining) does.
    private static function joinsPrev($cp): bool
    {
        return $cp !== null && isset(self::$forms[$cp]);
    }

    private static function toUtf8(int $codepoint): string
    {
        return mb_chr($codepoint, 'UTF-8');
    }
}
