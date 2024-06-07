<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $path = isset($_GET['path']) ? $_GET['path'] : '';
    $rnd = isset($_GET['rnd']) ? $_GET['rnd'] : '';

    // Validate the path
    if (preg_match('/^highscores\/(\d+)\/(\d+)\/(\d+)\.txt$/', $path, $matches)) {
        // Extracting the numbers and formatting as needed
        $number = str_pad($matches[1], 1, '0', STR_PAD_LEFT) .
                  str_pad($matches[2], 2, '0', STR_PAD_LEFT) .
                  str_pad($matches[3], 3, '0', STR_PAD_LEFT);

        // Content to be written in the file
        $content = $number;
        if ($rnd !== '') {
            $content .= "\n$rnd";
        }

        // Sending headers for the file download
        header('Content-Type: text/plain');
        header('Content-Disposition: attachment; filename="' . basename($path) . '"');
        echo $content;
    } else {
        // Invalid path
        http_response_code(400);
        echo "Invalid path format.";
    }
} else {
    // Not a GET request
    http_response_code(405);
    echo "Method not allowed.";
}
?>
