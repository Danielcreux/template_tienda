<?php
function render_template($template_file, $data) {
    if (!file_exists($template_file)) {
        return "Template file not found: $template_file";
    }

    $template = file_get_contents($template_file);

    // Process loops first
    foreach ($data as $key => $value) {
        if (is_array($value)) {
            $pattern = '/<template\s+id="' . preg_quote($key, '/') . '">(.*?)<\/template>/s';
            
            if (preg_match($pattern, $template, $matches)) {
                $loop_content = '';
                $item_template = $matches[1];
                
                foreach ($value as $item) {
                    $processed_item = $item_template;
                    foreach ($item as $item_key => $item_value) {
                        $processed_item = str_replace(
                            '{' . $item_key . '}', 
                            htmlspecialchars($item_value), 
                            $processed_item
                        );
                    }
                    $loop_content .= $processed_item;
                }
                
                $template = preg_replace($pattern, $loop_content, $template);
            }
        }
    }

    // Then process simple replacements
    foreach ($data as $key => $value) {
        if (!is_array($value)) {
            $template = str_replace('{' . $key . '}', htmlspecialchars($value), $template);
        }
    }

    return $template;
}