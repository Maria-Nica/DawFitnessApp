<?php
// /app/Core/Escaper.php

class Escaper {
    public static function escape(?string $value): string {
        if ($value === null) return '';
        return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}
