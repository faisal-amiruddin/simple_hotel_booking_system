<?php
class Form
{
    public $fields = array();
    public $action;
    public $title = "";
    public $submit = "";
    public $jumField = 0;

    public function __construct($action, $title, $submit)
    {
        $this->action = $action;
        $this->title = $title;
        $this->submit = $submit;
    }

    public function addField($name, $label, $type = 'text', $options = [])
    {
        $this->fields[$this->jumField] = [
            'name'      => $name,
            'label'     => $label,
            'type'      => $type,
            'value'     => $options['value'] ?? '',
            'placeholder' => $options['placeholder'] ?? '',
            'options'   => $options['options'] ?? [],
            'checked'   => $options['checked'] ?? false,
        ];
        $this->jumField++;
    }

    public function displayForm()
    {
        echo "<div class='container d-flex justify-content-center align-items-center' style='min-height:100vh;'>";
        echo "<div class='card shadow' style='max-width:400px; width:100%;'>";
        echo "<div class='card-body'>";
        echo "<h4 class='card-title mb-4 text-center'>" . htmlspecialchars($this->title, ENT_QUOTES, 'UTF-8') . "</h4>";

        echo "<form action='" . htmlspecialchars($this->action, ENT_QUOTES, 'UTF-8') . "' method='post'>";

        foreach ($this->fields as $field) {
            $name        = htmlspecialchars($field['name'], ENT_QUOTES, 'UTF-8');
            $label       = htmlspecialchars($field['label'], ENT_QUOTES, 'UTF-8');
            $type        = $field['type'];
            $value       = htmlspecialchars($field['value'], ENT_QUOTES, 'UTF-8');
            $placeholder = htmlspecialchars($field['placeholder'], ENT_QUOTES, 'UTF-8');
            $options     = $field['options'];
            $checked     = $field['checked'];

            echo "<div class='mb-3'>";
            echo "<label for='{$name}' class='form-label'>{$label}</label>";

            switch ($type) {
                case 'textarea':
                    echo "<textarea class='form-control' required id='{$name}' name='{$name}' placeholder='{$placeholder}' rows='4'>{$value}</textarea>";
                    break;

                case 'select':
                    echo "<select class='form-select' required id='{$name}' name='{$name}'>";
                    foreach ($options as $optValue => $optLabel) {
                        $selected = ($optValue == $value) ? ' selected' : '';
                        $optValueEsc = htmlspecialchars($optValue, ENT_QUOTES, 'UTF-8');
                        $optLabelEsc = htmlspecialchars($optLabel, ENT_QUOTES, 'UTF-8');
                        echo "<option value='{$optValueEsc}'{$selected}>{$optLabelEsc}</option>";
                    }
                    echo "</select>";
                    break;

                case 'checkbox':
                    $checkedAttr = $checked ? ' checked' : '';
                    echo "<div class='form-check'>";
                    echo "<input class='form-check-input' required type='checkbox' id='{$name}' name='{$name}' value='{$value}'{$checkedAttr}>";
                    echo "<label class='form-check-label' for='{$name}'>{$label}</label>";
                    echo "</div>";
                    break;

                case 'radio':
                    foreach ($options as $optValue => $optLabel) {
                        $checkedAttr = ($optValue == $value) ? ' checked' : '';
                        $optValueEsc = htmlspecialchars($optValue, ENT_QUOTES, 'UTF-8');
                        $optLabelEsc = htmlspecialchars($optLabel, ENT_QUOTES, 'UTF-8');
                        echo "<div class='form-check'>";
                        echo "<input class='form-check-input' required type='radio' name='{$name}' id='{$name}_{$optValueEsc}' value='{$optValueEsc}'{$checkedAttr}>";
                        echo "<label class='form-check-label' for='{$name}_{$optValueEsc}'>{$optLabelEsc}</label>";
                        echo "</div>";
                    }
                    break;

                default:
                    $placeholderAttr = $placeholder ? " placeholder='{$placeholder}'" : '';
                    echo "<input type='{$type}' class='form-control' required id='{$name}' name='{$name}' value='{$value}'{$placeholderAttr}>";
                    break;
            }

            echo "</div>";
        }

        echo "<div class='d-grid'>";
        echo "<button type='submit' name='tombol' class='btn btn-primary'>" . htmlspecialchars($this->submit, ENT_QUOTES, 'UTF-8') . "</button>";
        echo "</div>";

        echo "</form>";
        echo "</div>"; // card-body
        echo "</div>"; // card
        echo "</div>"; // container
    }

}
