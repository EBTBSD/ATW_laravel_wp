<?php
/**
 * Plugin Name: Laravel Update Connector
 * Description: Elküldi a frissítések számát a Laravel API-nak.
 * Version: 1.0
 * Author: Te Neved
 */

// Biztonsági ellenőrzés: Ha nem a WordPress futtatja, álljon le.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// 1. LÉPÉS: Egyedi 5 perces időzítés hozzáadása
add_filter( 'cron_schedules', 'luc_add_5min_interval' );

function luc_add_5min_interval( $schedules ) {
    $schedules['every_five_minutes'] = array(
        'interval' => 300, // 300 másodperc = 5 perc
        'display'  => __( '5 percenként', 'laravel-connector' )
    );
    return $schedules;
}

// 2. LÉPÉS: Maga a funkció, ami elküldi az adatokat
add_action( 'luc_send_event', 'luc_send_to_laravel' );

function luc_send_to_laravel() {
    // Frissítések számának lekérése
    $update_data = wp_get_update_data();
    $count       = $update_data['counts']['total'];

    // Laravel API végpont (FIGYELJ A PORTRA!)
    // Ha a Laravel a 8000-es porton fut:
    $url = 'http://127.0.0.1:8000/log/increment';

    // Adatok küldése POST kéréssel
    $response = wp_remote_post( $url, array(
        'body'      => array(
            'domain' => 'localhost-wp', // Ennek a névnek lennie kell a Laravel DB-ben
            'count'  => $count
        ),
        'timeout'   => 45,
        'sslverify' => false, // Localhost miatt kell kikapcsolni
    ));

    // Opcionális: Hiba naplózása a szerverre, ha nem sikerült
    if ( is_wp_error( $response ) ) {
        error_log( 'Laravel Connector Hiba: ' . $response->get_error_message() );
    }
}

// 3. LÉPÉS: Aktiváláskor időzítő indítása
register_activation_hook( __FILE__, 'luc_activate_plugin' );

function luc_activate_plugin() {
    if ( ! wp_next_scheduled( 'luc_send_event' ) ) {
        wp_schedule_event( time(), 'every_five_minutes', 'luc_send_event' );
    }
}

// 4. LÉPÉS: Kikapcsoláskor időzítő törlése
register_deactivation_hook( __FILE__, 'luc_deactivate_plugin' );

function luc_deactivate_plugin() {
    wp_clear_scheduled_hook( 'luc_send_event' );
}