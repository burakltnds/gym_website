<?php
function kasRengiHesapla($mevcut_xp, $max_xp = 1000) {

    if ($mevcut_xp <= 0) {
        return "#e2e8f0"; 
    }

    $oran = $mevcut_xp / $max_xp;
    if ($oran > 1) { 
        $oran = 1;
    }

    $alpha = 0.2 + ($oran * 0.8);

    return "rgba(74, 222, 128, " . $alpha . ")";
}

if (!function_exists('seviyeHesapla')) {
    function seviyeHesapla($xp) {
        if ($xp <= 0) return 1; 
        
        return floor($xp / 100) + 1;
    }
}
?>