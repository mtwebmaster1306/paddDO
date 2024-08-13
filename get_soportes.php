<?php
// get_soportes.php

// Configuración de Supabase
$supabaseUrl = 'https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/';
$supabaseKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc'; // Reemplaza esto con tu clave API real

if (isset($_GET['proveedor_id'])) {
    $proveedor_id = $_GET['proveedor_id'];
    
    // URL para obtener los soportes del proveedor
    $url = $supabaseUrl . 'Soportes?select=*&id_proveedor=eq.'. $proveedor_id;

    // Inicializar cURL
    $ch = curl_init();

    // Configurar opciones de cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'apikey: ' . $supabaseKey,
        'Authorization: Bearer ' . $supabaseKey
    ));

    // Ejecutar la solicitud
    $response = curl_exec($ch);

    // Cerrar la sesión cURL
    curl_close($ch);

    // Verificar si la solicitud fue exitosa
    if ($response === false) {
        echo json_encode(array('error' => 'Error en la solicitud a Supabase'));
    } else {
        // Devolver los soportes en formato JSON
        echo $response;
    }
} else {
    echo json_encode(array('error' => 'No se proporcionó ID de proveedor'));
}