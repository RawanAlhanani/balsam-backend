@php
    // dompdf doesn't shape Arabic text (see App\Support\ArabicShaper) - every
    // string that contains Arabic, static labels included, must be passed
    // through ar() below or it renders as disconnected isolated letters.
    if (!function_exists('ar')) {
        function ar($text) {
            return \App\Support\ArabicShaper::reshape((string) $text);
        }
    }
@endphp
<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
<meta charset="utf-8" />
<title>{{ ar('تقرير اجتماع') }}</title>
<style>
    * { font-family: DejaVu Sans, sans-serif; }
    body { margin: 0; padding: 0; }
    @page { margin: 0; }

    .background-frame { position: fixed; top: 0; left: 0; width: 210mm; height: 297mm; z-index: -1; }
    .background-frame img { width: 100%; height: 100%; }

    .content { padding: 55mm 25mm 45mm 25mm; }

    .header-title { text-align: center; margin-bottom: 24px; }
    .title { font-size: 22px; font-weight: bold; color: #1a5a96; }

    table.info-table { width: 100%; border-collapse: collapse; margin-bottom: 22px; }
    table.info-table td { width: 50%; border-bottom: 1px dashed #bbb; padding: 6px; font-size: 13px; }
    .info-label { font-weight: bold; color: #333; }

    .section { margin-bottom: 16px; }
    .section-title { font-size: 15px; font-weight: bold; color: #1a5a96; border-right: 4px solid #1a5a96; padding-right: 10px; margin-bottom: 6px; }
    .section-content { padding: 4px 12px; font-size: 13px; white-space: pre-wrap; }

    table.sign-table { width: 100%; margin-top: 36px; }
    table.sign-table td { width: 50%; text-align: center; border-top: 1px solid #999; padding-top: 8px; font-weight: bold; font-size: 13px; }
</style>
</head>
<body>
    <div class="background-frame">
        <img src="{{ public_path('images/meeting-letterhead.jpg') }}" alt="خلفية" />
    </div>

    <div class="content">
        <div class="header-title">
            <div class="title">{{ ar('محضر اجتماع الجمعية') }}</div>
        </div>

        <table class="info-table">
            <tr>
                <td><span class="info-label">{{ ar('التاريخ:') }}</span> {{ ar($meeting->date) }}</td>
                <td><span class="info-label">{{ ar('المكان:') }}</span> {{ ar($meeting->location) }}</td>
            </tr>
            <tr>
                <td><span class="info-label">{{ ar('من:') }}</span> {{ ar($meeting->start_time) }}</td>
                <td><span class="info-label">{{ ar('إلى:') }}</span> {{ ar($meeting->end_time) }}</td>
            </tr>
        </table>

        <div class="section">
            <div class="section-title">{{ ar('الحضور') }}</div>
            <div class="section-content">{{ ar($meeting->attendees ?: '---') }}</div>
        </div>

        <div class="section">
            <div class="section-title">{{ ar('جدول الأعمال') }}</div>
            <div class="section-content">{{ ar($meeting->agenda ?: '---') }}</div>
        </div>

        <div class="section">
            <div class="section-title">{{ ar('مداولات الاجتماع') }}</div>
            <div class="section-content">{{ ar($meeting->discussions ?: '---') }}</div>
        </div>

        <div class="section">
            <div class="section-title">{{ ar('القرارات المتخذة') }}</div>
            <div class="section-content">{{ ar($meeting->decisions ?: '---') }}</div>
        </div>

        @if($meeting->next_meeting_date)
        <div class="section">
            <div class="section-title">{{ ar('موعد الاجتماع المقبل') }}</div>
            <div class="section-content">{{ ar($meeting->next_meeting_date) }}</div>
        </div>
        @endif

        <table class="sign-table">
            <tr>
                <td>{{ ar('توقيع الكاتب العام') }}</td>
                <td>{{ ar('توقيع رئيس الجمعية') }}</td>
            </tr>
        </table>
    </div>
</body>
</html>
