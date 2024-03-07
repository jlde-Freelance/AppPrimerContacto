<?php


/**
 * All global usage functions of the application are recorded here.
 */

if (!function_exists('unformatMoney')) {
    function unformatMoney($money): float {
        $cleanString = preg_replace('/([^0-9\.,])/i', '', $money);
        $onlyNumbersString = preg_replace('/([^0-9])/i', '', $money);
        $separatorsCountToBeErased = strlen($cleanString) - strlen($onlyNumbersString) - 1;
        $stringWithCommaOrDot = preg_replace('/([,\.])/', '', $cleanString, $separatorsCountToBeErased);
        $removedThousandSeparator = preg_replace('/(\.|,)(?=[0-9]{3,}$)/', '', $stringWithCommaOrDot);
        return (float)str_replace(',', '.', $removedThousandSeparator);
    }

}

if (!function_exists('formatMoney')) {
    function formatMoney($money): string {
        return sprintf('$ %s', number_format($money, 0, "", "."));
    }
}

if (!function_exists('form_input_select_value')) {
    function form_input_select_value($multiple, $key, $value, $option = null): bool {
        if (empty($value) && $value != '0') return false;
        if ($multiple) {
            $_value = !is_array($value) ? json_decode($value, true) : $value;
            return in_array(str($key), $_value);
        } elseif (is_array($option) && array_key_exists('id', (array)$option)) {
            return str($value) == str($option['id']);
        } else {
            return str($key) == str($value);
        }
    }
}

if (!function_exists('form_input_render_option')) {
    function form_input_render_option($key, $selected, $option): string {
        $_selected = $selected ? 'selected' : '';
        if (is_array($option)) {
            $_id = $option["id"];
            $_text = $option["text"];
            $_disabled = ($option["disabled"] ?? false) ? 'disabled' : '';
            return "<option value=\"$_id\" $_selected $_disabled>$_text</option>";
        }
        return "<option value=\"$key\" $_selected>$option</option>";
    }
}

