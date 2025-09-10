<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\Template;
use App\Models\Form;
use Exception;


class FormBuilderController extends Controller
{

    public function builderComponents(Request $request)
    {
        if (!$request->ajax()) {
            abort(404);
        }

        // translations (Laravel __() helper)
        $i18n = [
            'heading' => __('Heading'),
            'paragraphText' => __('You can edit this paragraph by clicking here.'),
            'npsQuestion' => __('On a scale from 0-10, how likely are you to recommend our company to a friend or colleague?'),
            'notAtAllLikely' => __('Not at all likely'),
            'neutral' => __('Neutral'),
            'extremelyLikely' => __('Extremely likely'),
            'numberField' => __('Number Field'),
            'dateField' => __('Date Field'),
            'emailField' => __('Email Field'),
            'textArea' => __('Text Area'),
            'textField' => __('Text Field'),
            'checkAllThatApply' => __('Check All That Apply'),
            'selectAChoice' => __('Select a Choice'),
            'firstChoice' => __('First Choice'),
            'secondChoice' => __('Second Choice'),
            'thirdChoice' => __('Third Choice'),
            'signature' => __('Signature'),
            'answerTheFollowingQuestions' => __('Answer the following questions'),
            'firstQuestion' => __('First Question'),
            'secondQuestion' => __('Second Question'),
            'thirdQuestion' => __('Third Question'),
            'answerA' => __('Answer A'),
            'answerB' => __('Answer B'),
            'answerC' => __('Answer C'),
            'clear' => __('Clear'),
            'undo' => __('Undo'),
            'color' => __('Color'),
            'attachAFile' => __('Attach a File'),
            'belowInputs' => __('Below inputs'),
            'aboveInputs' => __('Above inputs'),
            'replaceThisCode' => __('Replace this :startTagcode:endTag with your html snippet.', [
                'startTag' => '<code>',
                'endTag' => '</code>',
            ]),
            'buttonText' => __('Submit'),
            'previous' => __('Previous'),
            'next' => __('Next'),
        ];

        // components array (converted from the JSON in your Yii code)
        $components = [
            [
                "name" => "heading",
                "title" => "heading.title",
                "fields" => [
                    "id" => [
                        "label" => "component.id",
                        "type" => "input",
                        "value" => "heading",
                    ],
                    "text" => [
                        "label" => "component.text",
                        "type" => "input",
                        "value" => $i18n['heading'],
                    ],
                    "type" => [
                        "label" => "component.type",
                        "type" => "select",
                        "value" => [
                            ["value" => "h1", "label" => "H1", "selected" => false],
                            ["value" => "h2", "label" => "H2", "selected" => true],
                            ["value" => "h3", "label" => "H3", "selected" => false],
                            ["value" => "h4", "label" => "H4", "selected" => false],
                            ["value" => "h5", "label" => "H5", "selected" => false],
                            ["value" => "h6", "label" => "H6", "selected" => false],
                        ],
                    ],
                    "cssClass" => [
                        "label" => "component.cssClass",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "containerClass" => [
                        "label" => "component.containerClass",
                        "type" => "input",
                        "value" => "col-12",
                        "advanced" => true,
                    ],
                ],
            ],

            [
                "name" => "paragraph",
                "title" => "paragraph.title",
                "fields" => [
                    "id" => [
                        "label" => "component.id",
                        "type" => "input",
                        "value" => "paragraph",
                    ],
                    "text" => [
                        "label" => "component.text",
                        "type" => "textarea",
                        "value" => $i18n['paragraphText'],
                    ],
                    "cssClass" => [
                        "label" => "component.cssClass",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "containerClass" => [
                        "label" => "component.containerClass",
                        "type" => "input",
                        "value" => "col-12",
                        "advanced" => true,
                    ],
                ],
            ],

            [
                "name" => "text",
                "title" => "text.title",
                "fields" => [
                    "id" => [
                        "label" => "component.id",
                        "type" => "input",
                        "value" => "text",
                    ],
                    "inputType" => [
                        "label" => "component.inputType",
                        "type" => "select",
                        "value" => [
                            ["value" => "text", "label" => "Text", "selected" => true],
                            ["value" => "tel", "label" => "Tel", "selected" => false],
                            ["value" => "url", "label" => "URL", "selected" => false],
                            ["value" => "color", "label" => "Color", "selected" => false],
                            ["value" => "password", "label" => "Password", "selected" => false],
                        ],
                    ],
                    "label" => [
                        "label" => "component.label",
                        "type" => "input",
                        "value" => $i18n['textField'],
                    ],
                    "placeholder" => [
                        "label" => "component.placeholder",
                        "type" => "input",
                        "value" => "",
                    ],
                    "predefinedValue" => [
                        "label" => "component.predefinedValue",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "helpText" => [
                        "label" => "component.helpText",
                        "type" => "textarea",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "helpTextPlacement" => [
                        "label" => "component.helpTextPlacement",
                        "type" => "select",
                        "value" => [
                            ["value" => "below", "label" => "component.belowInputs", "selected" => true],
                            ["value" => "above", "label" => "component.aboveInputs", "selected" => false],
                        ],
                        "advanced" => true,
                    ],
                    "prepend" => [
                        "label" => "component.prepend",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "append" => [
                        "label" => "component.append",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "minlength" => [
                        "label" => "component.minlength",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "maxlength" => [
                        "label" => "component.maxlength",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "pattern" => [
                        "label" => "component.pattern",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "cssClass" => [
                        "label" => "component.cssClass",
                        "type" => "input",
                        "value" => "form-control",
                        "advanced" => true,
                    ],
                    "labelClass" => [
                        "label" => "component.labelClass",
                        "type" => "input",
                        "value" => "form-label",
                        "advanced" => true,
                    ],
                    "inputGroupClass" => [
                        "label" => "component.inputGroupClass",
                        "type" => "input",
                        "value" => "input-group input-group-flat",
                        "advanced" => true,
                    ],
                    "containerClass" => [
                        "label" => "component.containerClass",
                        "type" => "input",
                        "value" => "col-12",
                        "advanced" => true,
                    ],
                    "alias" => [
                        "label" => "component.alias",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "customAttributes" => [
                        "label" => "component.customAttributes",
                        "type" => "choice",
                        "value" => [""],
                        "advanced" => true,
                    ],
                    "required" => [
                        "label" => "component.required",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true,
                    ],
                    "readOnly" => [
                        "label" => "component.readOnly",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true,
                    ],
                    "disabled" => [
                        "label" => "component.disabled",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true,
                    ],
                    "unique" => [
                        "label" => "component.unique",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true,
                    ],
                ],
            ],

            [
                "name" => "number",
                "title" => "number.title",
                "fields" => [
                    "id" => [
                        "label" => "component.id",
                        "type" => "input",
                        "value" => "number",
                    ],
                    "inputType" => [
                        "label" => "component.inputType",
                        "type" => "select",
                        "value" => [
                            ["value" => "number", "label" => "Number", "selected" => true],
                            ["value" => "range", "label" => "Range", "selected" => false],
                        ],
                    ],
                    "label" => [
                        "label" => "component.label",
                        "type" => "input",
                        "value" => $i18n['numberField'],
                    ],
                    "placeholder" => [
                        "label" => "component.placeholder",
                        "type" => "input",
                        "value" => "",
                    ],
                    "predefinedValue" => [
                        "label" => "component.predefinedValue",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "helpText" => [
                        "label" => "component.helpText",
                        "type" => "textarea",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "helpTextPlacement" => [
                        "label" => "component.helpTextPlacement",
                        "type" => "select",
                        "value" => [
                            ["value" => "below", "label" => "component.belowInputs", "selected" => true],
                            ["value" => "above", "label" => "component.aboveInputs", "selected" => false],
                        ],
                        "advanced" => true,
                    ],
                    "prepend" => [
                        "label" => "component.prepend",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "append" => [
                        "label" => "component.append",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "min" => [
                        "label" => "component.minNumber",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "max" => [
                        "label" => "component.maxNumber",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "step" => [
                        "label" => "component.stepNumber",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "integerPattern" => [
                        "label" => "component.integerPattern",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "numberPattern" => [
                        "label" => "component.numberPattern",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "cssClass" => [
                        "label" => "component.cssClass",
                        "type" => "input",
                        "value" => "form-control",
                        "advanced" => true,
                    ],
                    "labelClass" => [
                        "label" => "component.labelClass",
                        "type" => "input",
                        "value" => "form-label",
                        "advanced" => true,
                    ],
                    "inputGroupClass" => [
                        "label" => "component.inputGroupClass",
                        "type" => "input",
                        "value" => "input-group input-group-flat",
                        "advanced" => true,
                    ],
                    "containerClass" => [
                        "label" => "component.containerClass",
                        "type" => "input",
                        "value" => "col-12",
                        "advanced" => true,
                    ],
                    "alias" => [
                        "label" => "component.alias",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "customAttributes" => [
                        "label" => "component.customAttributes",
                        "type" => "choice",
                        "value" => [""],
                        "advanced" => true,
                    ],
                    "required" => [
                        "label" => "component.required",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true,
                    ],
                    "readOnly" => [
                        "label" => "component.readOnly",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true,
                    ],
                    "disabled" => [
                        "label" => "component.disabled",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true,
                    ],
                    "unique" => [
                        "label" => "component.unique",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true,
                    ],
                    "integerOnly" => [
                        "label" => "component.integerOnly",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true,
                    ],
                ],
            ],

            [
                "name" => "date",
                "title" => "date.title",
                "fields" => [
                    "id" => [
                        "label" => "component.id",
                        "type" => "input",
                        "value" => "date",
                    ],
                    "inputType" => [
                        "label" => "component.inputType",
                        "type" => "select",
                        "value" => [
                            ["value" => "date", "label" => "Date", "selected" => true],
                            ["value" => "datetime-local", "label" => "DateTime-Local", "selected" => false],
                            ["value" => "time", "label" => "Time", "selected" => false],
                            ["value" => "month", "label" => "Month", "selected" => false],
                            ["value" => "week", "label" => "Week", "selected" => false],
                        ],
                    ],
                    "label" => [
                        "label" => "component.label",
                        "type" => "input",
                        "value" => $i18n['dateField'],
                    ],
                    "placeholder" => [
                        "label" => "component.placeholder",
                        "type" => "input",
                        "value" => "",
                    ],
                    "predefinedValue" => [
                        "label" => "component.predefinedValue",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "helpText" => [
                        "label" => "component.helpText",
                        "type" => "textarea",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "helpTextPlacement" => [
                        "label" => "component.helpTextPlacement",
                        "type" => "select",
                        "value" => [
                            ["value" => "below", "label" => "component.belowInputs", "selected" => true],
                            ["value" => "above", "label" => "component.aboveInputs", "selected" => false],
                        ],
                        "advanced" => true,
                    ],
                    "prepend" => [
                        "label" => "component.prepend",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "append" => [
                        "label" => "component.append",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "min" => [
                        "label" => "component.minDate",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "max" => [
                        "label" => "component.maxDate",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "step" => [
                        "label" => "component.stepNumber",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "cssClass" => [
                        "label" => "component.cssClass",
                        "type" => "input",
                        "value" => "form-control",
                        "advanced" => true,
                    ],
                    "labelClass" => [
                        "label" => "component.labelClass",
                        "type" => "input",
                        "value" => "form-label",
                        "advanced" => true,
                    ],
                    "inputGroupClass" => [
                        "label" => "component.inputGroupClass",
                        "type" => "input",
                        "value" => "input-group input-group-flat",
                        "advanced" => true,
                    ],
                    "containerClass" => [
                        "label" => "component.containerClass",
                        "type" => "input",
                        "value" => "col-12",
                        "advanced" => true,
                    ],
                    "alias" => [
                        "label" => "component.alias",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "customAttributes" => [
                        "label" => "component.customAttributes",
                        "type" => "choice",
                        "value" => [""],
                        "advanced" => true,
                    ],
                    "required" => [
                        "label" => "component.required",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true,
                    ],
                    "readOnly" => [
                        "label" => "component.readOnly",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true,
                    ],
                    "disabled" => [
                        "label" => "component.disabled",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true,
                    ],
                    "unique" => [
                        "label" => "component.unique",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true,
                    ],
                ],
            ],

            [
                "name" => "email",
                "title" => "email.title",
                "fields" => [
                    "id" => [
                        "label" => "component.id",
                        "type" => "input",
                        "value" => "email",
                    ],
                    "label" => [
                        "label" => "component.label",
                        "type" => "input",
                        "value" => $i18n['emailField'],
                    ],
                    "placeholder" => [
                        "label" => "component.placeholder",
                        "type" => "input",
                        "value" => "",
                    ],
                    "predefinedValue" => [
                        "label" => "component.predefinedValue",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "helpText" => [
                        "label" => "component.helpText",
                        "type" => "textarea",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "helpTextPlacement" => [
                        "label" => "component.helpTextPlacement",
                        "type" => "select",
                        "value" => [
                            ["value" => "below", "label" => "component.belowInputs", "selected" => true],
                            ["value" => "above", "label" => "component.aboveInputs", "selected" => false],
                        ],
                        "advanced" => true,
                    ],
                    "prepend" => [
                        "label" => "component.prepend",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "append" => [
                        "label" => "component.append",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "minlength" => [
                        "label" => "component.minlength",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "maxlength" => [
                        "label" => "component.maxlength",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "pattern" => [
                        "label" => "component.pattern",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "cssClass" => [
                        "label" => "component.cssClass",
                        "type" => "input",
                        "value" => "form-control",
                        "advanced" => true,
                    ],
                    "labelClass" => [
                        "label" => "component.labelClass",
                        "type" => "input",
                        "value" => "form-label",
                        "advanced" => true,
                    ],
                    "inputGroupClass" => [
                        "label" => "component.inputGroupClass",
                        "type" => "input",
                        "value" => "input-group input-group-flat",
                        "advanced" => true,
                    ],
                    "containerClass" => [
                        "label" => "component.containerClass",
                        "type" => "input",
                        "value" => "col-12",
                        "advanced" => true,
                    ],
                    "alias" => [
                        "label" => "component.alias",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "customAttributes" => [
                        "label" => "component.customAttributes",
                        "type" => "choice",
                        "value" => [""],
                        "advanced" => true,
                    ],
                    "required" => [
                        "label" => "component.required",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true,
                    ],
                    "readOnly" => [
                        "label" => "component.readOnly",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true,
                    ],
                    "disabled" => [
                        "label" => "component.disabled",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true,
                    ],
                    "unique" => [
                        "label" => "component.unique",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true,
                    ],
                    "checkdns" => [
                        "label" => "component.checkDNS",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true,
                    ],
                    "multiple" => [
                        "label" => "component.multiple",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true,
                    ],
                ],
            ],

            [
                "name" => "textarea",
                "title" => "textarea.title",
                "fields" => [
                    "id" => [
                        "label" => "component.id",
                        "type" => "input",
                        "value" => "textarea",
                    ],
                    "label" => [
                        "label" => "component.label",
                        "type" => "input",
                        "value" => $i18n['textArea'],
                    ],
                    "placeholder" => [
                        "label" => "component.placeholder",
                        "type" => "input",
                        "value" => "",
                    ],
                    "predefinedValue" => [
                        "label" => "component.predefinedValue",
                        "type" => "textarea",
                        "value" => "",
                    ],
                    "helpText" => [
                        "label" => "component.helpText",
                        "type" => "textarea",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "helpTextPlacement" => [
                        "label" => "component.helpTextPlacement",
                        "type" => "select",
                        "value" => [
                            ["value" => "below", "label" => "component.belowInputs", "selected" => true],
                            ["value" => "above", "label" => "component.aboveInputs", "selected" => false],
                        ],
                        "advanced" => true,
                    ],
                    "prepend" => [
                        "label" => "component.prepend",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "append" => [
                        "label" => "component.append",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "minlength" => [
                        "label" => "component.minlength",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "maxlength" => [
                        "label" => "component.maxlength",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "fieldSize" => [
                        "label" => "component.fieldSize",
                        "type" => "input",
                        "value" => 3,
                        "advanced" => true,
                    ],
                    "cssClass" => [
                        "label" => "component.cssClass",
                        "type" => "input",
                        "value" => "form-control",
                        "advanced" => true,
                    ],
                    "labelClass" => [
                        "label" => "component.labelClass",
                        "type" => "input",
                        "value" => "form-label",
                        "advanced" => true,
                    ],
                    "inputGroupClass" => [
                        "label" => "component.inputGroupClass",
                        "type" => "input",
                        "value" => "input-group input-group-flat",
                        "advanced" => true,
                    ],
                    "containerClass" => [
                        "label" => "component.containerClass",
                        "type" => "input",
                        "value" => "col-12",
                        "advanced" => true,
                    ],
                    "alias" => [
                        "label" => "component.alias",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "customAttributes" => [
                        "label" => "component.customAttributes",
                        "type" => "choice",
                        "value" => [""],
                        "advanced" => true,
                    ],
                    "required" => [
                        "label" => "component.required",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true,
                    ],
                    "readOnly" => [
                        "label" => "component.readOnly",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true,
                    ],
                    "disabled" => [
                        "label" => "component.disabled",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true,
                    ],
                    "unique" => [
                        "label" => "component.unique",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true,
                    ],
                ],
            ],

            [
                "name" => "checkbox",
                "title" => "checkbox.title",
                "fields" => [
                    "id" => [
                        "label" => "component.groupName",
                        "type" => "input",
                        "value" => "checkbox",
                    ],
                    "label" => [
                        "label" => "component.label",
                        "type" => "input",
                        "value" => $i18n['checkAllThatApply'],
                    ],
                    "checkboxes" => [
                        "label" => "component.checkboxes",
                        "type" => "choice",
                        "value" => [
                            $i18n['firstChoice'] . "|selected",
                            $i18n['secondChoice'],
                            $i18n['thirdChoice'],
                        ],
                    ],
                    "helpText" => [
                        "label" => "component.helpText",
                        "type" => "textarea",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "helpTextPlacement" => [
                        "label" => "component.helpTextPlacement",
                        "type" => "select",
                        "value" => [
                            ["value" => "below", "label" => "component.belowInputs", "selected" => true],
                            ["value" => "above", "label" => "component.aboveInputs", "selected" => false],
                        ],
                        "advanced" => true,
                    ],
                    "cssClass" => [
                        "label" => "component.cssClass",
                        "type" => "input",
                        "value" => "form-check",
                        "advanced" => true,
                    ],
                    "labelClass" => [
                        "label" => "component.labelClass",
                        "type" => "input",
                        "value" => "form-label",
                        "advanced" => true,
                    ],
                    "containerClass" => [
                        "label" => "component.containerClass",
                        "type" => "input",
                        "value" => "col-12",
                        "advanced" => true,
                    ],
                    "alias" => [
                        "label" => "component.alias",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "customAttributes" => [
                        "label" => "component.customAttributes",
                        "type" => "choice",
                        "value" => [""],
                        "advanced" => true,
                    ],
                    "required" => [
                        "label" => "component.required",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true,
                    ],
                    "readOnly" => [
                        "label" => "component.readOnly",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true,
                    ],
                    "disabled" => [
                        "label" => "component.disabled",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true,
                    ],
                    "inline" => [
                        "label" => "component.inline",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true,
                    ],
                    "asButton" => [
                        "label" => "component.asButton",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true,
                    ],
                ],
            ],

            [
                "name" => "radio",
                "title" => "radio.title",
                "fields" => [
                    "id" => [
                        "label" => "component.groupName",
                        "type" => "input",
                        "value" => "radio",
                    ],
                    "label" => [
                        "label" => "component.label",
                        "type" => "input",
                        "value" => $i18n['selectAChoice'],
                    ],
                    "radios" => [
                        "label" => "component.radios",
                        "type" => "choice",
                        "value" => [
                            $i18n['firstChoice'] . "|selected",
                            $i18n['secondChoice'],
                            $i18n['thirdChoice'],
                        ],
                    ],
                    "helpText" => [
                        "label" => "component.helpText",
                        "type" => "textarea",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "helpTextPlacement" => [
                        "label" => "component.helpTextPlacement",
                        "type" => "select",
                        "value" => [
                            ["value" => "below", "label" => "component.belowInputs", "selected" => true],
                            ["value" => "above", "label" => "component.aboveInputs", "selected" => false],
                        ],
                        "advanced" => true,
                    ],
                    "cssClass" => [
                        "label" => "component.cssClass",
                        "type" => "input",
                        "value" => "form-check",
                        "advanced" => true,
                    ],
                    "labelClass" => [
                        "label" => "component.labelClass",
                        "type" => "input",
                        "value" => "form-label",
                        "advanced" => true,
                    ],
                    "containerClass" => [
                        "label" => "component.containerClass",
                        "type" => "input",
                        "value" => "col-12",
                        "advanced" => true,
                    ],
                    "alias" => [
                        "label" => "component.alias",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true,
                    ],
                    "customAttributes" => [
                        "label" => "component.customAttributes",
                        "type" => "choice",
                        "value" => [""],
                        "advanced" => true,
                    ],
                    "required" => [
                        "label" => "component.required",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true,
                    ],
                    "readOnly" => [
                        "label" => "component.readOnly",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true,
                    ],
                    "disabled" => [
                        "label" => "component.disabled",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true,
                    ],
                    "inline" => [
                        "label" => "component.inline",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true,
                    ],
                    "asButton" => [
                        "label" => "component.asButton",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true,
                    ],
                ],
            ],

            [
                "name" => "selectlist",
                "title" => "selectlist.title",
                "fields" => [
                    "id" => [
                        "label" => "component.id",
                        "type" => "input",
                        "value" => "selectlist"
                    ],
                    "label" => [
                        "label" => "component.label",
                        "type" => "input",
                        "value" => $i18n['selectAChoice']
                    ],
                    "options" => [
                        "label" => "component.options",
                        "type" => "choice",
                        "value" => [
                            $i18n['firstChoice'] . "|selected",
                            $i18n['secondChoice'],
                            $i18n['thirdChoice']
                        ]
                    ],
                    "placeholder" => [
                        "label" => "component.placeholder",
                        "type" => "input",
                        "value" => ""
                    ],
                    "helpText" => [
                        "label" => "component.helpText",
                        "type" => "textarea",
                        "value" => "",
                        "advanced" => true
                    ],
                    "helpTextPlacement" => [
                        "label" => "component.helpTextPlacement",
                        "type" => "select",
                        "value" => [
                            [
                                "value" => "below",
                                "label" => "component.belowInputs",
                                "selected" => true
                            ],
                            [
                                "value" => "above",
                                "label" => "component.aboveInputs",
                                "selected" => false
                            ]
                        ],
                        "advanced" => true
                    ],
                    "prepend" => [
                        "label" => "component.prepend",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true
                    ],
                    "append" => [
                        "label" => "component.append",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true
                    ],
                    "cssClass" => [
                        "label" => "component.cssClass",
                        "type" => "input",
                        "value" => "form-select",
                        "advanced" => true
                    ],
                    "labelClass" => [
                        "label" => "component.labelClass",
                        "type" => "input",
                        "value" => "form-label",
                        "advanced" => true
                    ],
                    "inputGroupClass" => [
                        "label" => "component.inputGroupClass",
                        "type" => "input",
                        "value" => "input-group",
                        "advanced" => true
                    ],
                    "containerClass" => [
                        "label" => "component.containerClass",
                        "type" => "input",
                        "value" => "col-12",
                        "advanced" => true
                    ],
                    "alias" => [
                        "label" => "component.alias",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true
                    ],
                    "customAttributes" => [
                        "label" => "component.customAttributes",
                        "type" => "choice",
                        "value" => [
                            ""
                        ],
                        "advanced" => true
                    ],
                    "required" => [
                        "label" => "component.required",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true
                    ],
                    "readOnly" => [
                        "label" => "component.readOnly",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true
                    ],
                    "disabled" => [
                        "label" => "component.disabled",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true
                    ],
                    "multiple" => [
                        "label" => "component.multiple",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true
                    ]
                ]
            ],
            [
                "name" => "hidden",
                "title" => "hidden.title",
                "fields" => [
                    "id" => [
                        "label" => "component.id",
                        "type" => "input",
                        "value" => "hidden"
                    ],
                    "label" => [
                        "label" => "component.label",
                        "type" => "input",
                        "value" => ""
                    ],
                    "predefinedValue" => [
                        "label" => "component.predefinedValue",
                        "type" => "input",
                        "value" => ""
                    ],
                    "alias" => [
                        "label" => "component.alias",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true
                    ],
                    "customAttributes" => [
                        "label" => "component.customAttributes",
                        "type" => "choice",
                        "value" => [
                            ""
                        ],
                        "advanced" => true
                    ],
                    "disabled" => [
                        "label" => "component.disabled",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true
                    ],
                    "unique" => [
                        "label" => "component.unique",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true
                    ]
                ]
            ],
            [
                "name" => "file",
                "title" => "file.title",
                "fields" => [
                    "id" => [
                        "label" => "component.id",
                        "type" => "input",
                        "value" => "file"
                    ],
                    "label" => [
                        "label" => "component.label",
                        "type" => "input",
                        "value" => $i18n['attachAFile']
                    ],
                    "accept" => [
                        "label" => "component.accept",
                        "type" => "input",
                        "value" => ".gif, .jpg, .png"
                    ],
                    "helpText" => [
                        "label" => "component.helpText",
                        "type" => "textarea",
                        "value" => "",
                        "advanced" => true
                    ],
                    "helpTextPlacement" => [
                        "label" => "component.helpTextPlacement",
                        "type" => "select",
                        "value" => [
                            [
                                "value" => "below",
                                "label" => "component.belowInputs",
                                "selected" => true
                            ],
                            [
                                "value" => "above",
                                "label" => "component.aboveInputs",
                                "selected" => false
                            ]
                        ],
                        "advanced" => true
                    ],
                    "prepend" => [
                        "label" => "component.prepend",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true
                    ],
                    "append" => [
                        "label" => "component.append",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true
                    ],
                    "minFiles" => [
                        "label" => "component.minFiles",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true
                    ],
                    "maxFiles" => [
                        "label" => "component.maxFiles",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true
                    ],

                    "minSize" => [
                        "label" => "component.minSize",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true
                    ],
                    "maxSize" => [
                        "label" => "component.maxSize",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true
                    ],
                    "cssClass" => [
                        "label" => "component.cssClass",
                        "type" => "input",
                        "value" => "form-control",
                        "advanced" => true
                    ],
                    "labelClass" => [
                        "label" => "component.labelClass",
                        "type" => "input",
                        "value" => "form-label",
                        "advanced" => true
                    ],
                    "inputGroupClass" => [
                        "label" => "component.inputGroupClass",
                        "type" => "input",
                        "value" => "input-group",
                        "advanced" => true
                    ],
                    "containerClass" => [
                        "label" => "component.containerClass",
                        "type" => "input",
                        "value" => "col-12",
                        "advanced" => true
                    ],
                    "alias" => [
                        "label" => "component.alias",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true
                    ],
                    "customAttributes" => [
                        "label" => "component.customAttributes",
                        "type" => "choice",
                        "value" => [
                            ""
                        ],
                        "advanced" => true
                    ],
                    "multiple" => [
                        "label" => "Allow Multiple Files",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true,
                    ],
                    "required" => [
                        "label" => "component.required",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true
                    ],
                    "readOnly" => [
                        "label" => "component.readOnly",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true
                    ],
                    "disabled" => [
                        "label" => "component.disabled",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true
                    ]
                ]
            ],
            [
                "name" => "snippet",
                "title" => "snippet.title",
                "fields" => [
                    "id" => [
                        "label" => "component.id",
                        "type" => "input",
                        "value" => "snippet"
                    ],
                    "snippet" => [
                        "label" => "component.htmlCode",
                        "type" => "textarea",
                        "value" => $i18n['replaceThisCode']
                    ],
                    "containerClass" => [
                        "label" => "component.containerClass",
                        "type" => "input",
                        "value" => "col-12",
                        "advanced" => true
                    ]
                ]
            ],
            // [
            //     "name" => "recaptcha",
            //     "title" => "recaptcha.title",
            //     "fields" => [
            //         "id" => [
            //             "label" => "component.id",
            //             "type" => "input",
            //             "value" => "recaptcha"
            //         ],
            //         "theme" => [
            //             "label" => "component.theme",
            //             "type" => "select",
            //             "value" => [
            //                 [
            //                     "value" => "light",
            //                     "label" => "Light",
            //                     "selected" => true
            //                 ],
            //                 [
            //                     "value" => "dark",
            //                     "label" => "Dark",
            //                     "selected" => false
            //                 ]
            //             ]
            //         ],
            //         "type" => [
            //             "label" => "component.type",
            //             "type" => "select",
            //             "value" => [
            //                 [
            //                     "value" => "image",
            //                     "label" => "Image",
            //                     "selected" => true
            //                 ],
            //                 [
            //                     "value" => "audio",
            //                     "label" => "Audio",
            //                     "selected" => false
            //                 ]
            //             ],
            //             "advanced" => true
            //         ],
            //         "size" => [
            //             "label" => "component.size",
            //             "type" => "select",
            //             "value" => [
            //                 [
            //                     "value" => "normal",
            //                     "label" => "Normal",
            //                     "selected" => true
            //                 ],
            //                 [
            //                     "value" => "compact",
            //                     "label" => "Compact",
            //                     "selected" => false
            //                 ]
            //             ],
            //             "advanced" => true
            //         ],
            //         "containerClass" => [
            //             "label" => "component.containerClass",
            //             "type" => "input",
            //             "value" => "col-12",
            //             "advanced" => true
            //         ]
            //     ]
            // ],
            // [
            //     "name" => "pagebreak",
            //     "title" => "pagebreak.title",
            //     "fields" => [
            //         "id" => [
            //             "label" => "component.id",
            //             "type" => "input",
            //             "value" => "pagebreak"
            //         ],
            //         "prev" => [
            //             "label" => "component.prev",
            //             "type" => "input",
            //             "value" => $i18n['previous']
            //         ],
            //         "next" => [
            //             "label" => "component.next",
            //             "type" => "input",
            //             "value" => $i18n['next']
            //         ]
            //     ]
            // ],
            [
                "name" => "spacer",
                "title" => "spacer.title",
                "fields" => [
                    "id" => [
                        "label" => "component.id",
                        "type" => "input",
                        "value" => "spacer"
                    ],
                    "height" => [
                        "label" => "component.height",
                        "type" => "number",
                        "value" => "50"
                    ],
                    "cssClass" => [
                        "label" => "component.cssClass",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true
                    ],
                    "containerClass" => [
                        "label" => "component.containerClass",
                        "type" => "input",
                        "value" => "col-12",
                        "advanced" => true
                    ]
                ]
            ],
            [
                "name" => "nps",
                "title" => "nps.title",
                "fields" => [
                    "id" => [
                        "label" => "component.id",
                        "type" => "input",
                        "value" => "nps"
                    ],
                    "question" => [
                        "label" => "component.question",
                        "type" => "input",
                        "value" => $i18n['npsQuestion']
                    ],
                    "labels" => [
                        "label" => "component.labels",
                        "type" => "choice",
                        "value" => [
                            $i18n['notAtAllLikely'] . "|selected",
                            $i18n['neutral'],
                            $i18n['extremelyLikely'] . "|selected"
                        ]
                    ],
                    "labelPlacement" => [
                        "label" => "component.labelPlacement",
                        "type" => "select",
                        "value" => [
                            [
                                "value" => "below",
                                "label" => "component.belowInputs",
                                "selected" => false
                            ],
                            [
                                "value" => "above",
                                "label" => "component.aboveInputs",
                                "selected" => true
                            ]
                        ],
                        "advanced" => true
                    ],
                    "helpText" => [
                        "label" => "component.helpText",
                        "type" => "textarea",
                        "value" => "",
                        "advanced" => true
                    ],
                    "helpTextPlacement" => [
                        "label" => "component.helpTextPlacement",
                        "type" => "select",
                        "value" => [
                            [
                                "value" => "below",
                                "label" => "component.belowInputs",
                                "selected" => true
                            ],
                            [
                                "value" => "above",
                                "label" => "component.aboveInputs",
                                "selected" => false
                            ]
                        ],
                        "advanced" => true
                    ],
                    "cssClass" => [
                        "label" => "component.cssClass",
                        "type" => "input",
                        "value" => "d-none",
                        "advanced" => true
                    ],
                    "questionClass" => [
                        "label" => "component.questionClass",
                        "type" => "input",
                        "value" => "form-label",
                        "advanced" => true
                    ],
                    "labelClass" => [
                        "label" => "component.labelClass",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true
                    ],
                    "buttonClass" => [
                        "label" => "component.buttonClass",
                        "type" => "input",
                        "value" => "btn btn-primary btn-nps",
                        "advanced" => true
                    ],
                    "containerClass" => [
                        "label" => "component.containerClass",
                        "type" => "input",
                        "value" => "col-12",
                        "advanced" => true
                    ],
                    "alias" => [
                        "label" => "component.alias",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true
                    ],
                    "customAttributes" => [
                        "label" => "component.customAttributes",
                        "type" => "choice",
                        "value" => [
                            ""
                        ],
                        "advanced" => true
                    ],
                    "required" => [
                        "label" => "component.required",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true
                    ],
                    "disabled" => [
                        "label" => "component.disabled",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true
                    ]
                ]
            ],
            [
                "name" => "matrix",
                "title" => "matrix.title",
                "fields" => [
                    "id" => [
                        "label" => "component.id",
                        "type" => "input",
                        "value" => "matrix"
                    ],
                    "inputType" => [
                        "label" => "component.inputType",
                        "type" => "select",
                        "value" => [
                            [
                                "value" => "radio",
                                "label" => "Radio Button",
                                "selected" => true
                            ],
                            [
                                "value" => "checkbox",
                                "label" => "Checkbox",
                                "selected" => false
                            ],
                            [
                                "value" => "select",
                                "label" => "Select List",
                                "selected" => false
                            ],
                            [
                                "value" => "text",
                                "label" => "Text",
                                "selected" => false
                            ],
                            [
                                "value" => "textarea",
                                "label" => "Text Area",
                                "selected" => false
                            ],
                            [
                                "value" => "number",
                                "label" => "Number",
                                "selected" => false
                            ],
                            [
                                "value" => "range",
                                "label" => "Range",
                                "selected" => false
                            ],
                            [
                                "value" => "email",
                                "label" => "Email",
                                "selected" => false
                            ],
                            [
                                "value" => "tel",
                                "label" => "Tel",
                                "selected" => false
                            ],
                            [
                                "value" => "url",
                                "label" => "URL",
                                "selected" => false
                            ],
                            [
                                "value" => "color",
                                "label" => "Color",
                                "selected" => false
                            ],
                            [
                                "value" => "password",
                                "label" => "Password",
                                "selected" => false
                            ],
                            [
                                "value" => "date",
                                "label" => "Date",
                                "selected" => false
                            ],
                            [
                                "value" => "datetime-local",
                                "label" => "DateTime-Local",
                                "selected" => false
                            ],
                            [
                                "value" => "time",
                                "label" => "Time",
                                "selected" => false
                            ],
                            [
                                "value" => "month",
                                "label" => "Month",
                                "selected" => false
                            ],
                            [
                                "value" => "week",
                                "label" => "Week",
                                "selected" => false
                            ]
                        ]
                    ],
                    "label" => [
                        "label" => "component.label",
                        "type" => "input",
                        "value" => $i18n['answerTheFollowingQuestions']
                    ],
                    "questions" => [
                        "label" => "component.questions",
                        "type" => "choice",
                        "value" => [
                            $i18n['firstQuestion'],
                            $i18n['secondQuestion'],
                            $i18n['thirdQuestion']
                        ]
                    ],
                    "answers" => [
                        "label" => "component.answers",
                        "type" => "choice",
                        "value" => [
                            $i18n['answerA'],
                            $i18n['answerB'],
                            $i18n['answerC']
                        ]
                    ],
                    "placeholder" => [
                        "label" => "component.placeholder",
                        "type" => "input",
                        "value" => ""
                    ],
                    "helpText" => [
                        "label" => "component.helpText",
                        "type" => "textarea",
                        "value" => ""
                    ],
                    "helpTextPlacement" => [
                        "label" => "component.helpTextPlacement",
                        "type" => "select",
                        "value" => [
                            [
                                "value" => "below",
                                "label" => "component.belowInputs",
                                "selected" => true
                            ],
                            [
                                "value" => "above",
                                "label" => "component.aboveInputs",
                                "selected" => false
                            ]
                        ],
                        "advanced" => true
                    ],
                    "pattern" => [
                        "label" => "component.pattern",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true
                    ],
                    "minlength" => [
                        "label" => "component.minlength",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true
                    ],
                    "maxlength" => [
                        "label" => "component.maxlength",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true
                    ],
                    "min" => [
                        "label" => "component.min",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true
                    ],
                    "max" => [
                        "label" => "component.max",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true
                    ],
                    "step" => [
                        "label" => "component.step",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true
                    ],
                    "cssClass" => [
                        "label" => "component.cssClass",
                        "type" => "input",
                        "value" => "form-control",
                        "advanced" => true
                    ],
                    "labelClass" => [
                        "label" => "component.labelClass",
                        "type" => "input",
                        "value" => "form-label",
                        "advanced" => true
                    ],
                    "tableClass" => [
                        "label" => "component.tableClass",
                        "type" => "input",
                        "value" => "table table-striped table-hover",
                        "advanced" => true
                    ],
                    "containerClass" => [
                        "label" => "component.containerClass",
                        "type" => "input",
                        "value" => "col-12",
                        "advanced" => true
                    ],
                    "alias" => [
                        "label" => "component.alias",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true
                    ],
                    "customAttributes" => [
                        "label" => "component.customAttributes",
                        "type" => "choice",
                        "value" => [
                            ""
                        ],
                        "advanced" => true
                    ],
                    "required" => [
                        "label" => "component.required",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true
                    ],
                    "readOnly" => [
                        "label" => "component.readOnly",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true
                    ],
                    "disabled" => [
                        "label" => "component.disabled",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true
                    ],
                    "inline" => [
                        "label" => "component.inline",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true
                    ],
                    "multiple" => [
                        "label" => "component.multiple",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true
                    ]
                ]
            ],
            [
                "name" => "signature",
                "title" => "signature.title",
                "fields" => [
                    "id" => [
                        "label" => "component.id",
                        "type" => "input",
                        "value" => "signature"
                    ],
                    "label" => [
                        "label" => "component.label",
                        "type" => "input",
                        "value" => $i18n['signature']
                    ],
                    "required" => [
                        "label" => "component.required",
                        "type" => "checkbox",
                        "value" => false
                    ],
                    "clear" => [
                        "label" => "component.clear",
                        "type" => "checkbox",
                        "value" => true
                    ],
                    "undo" => [
                        "label" => "component.undo",
                        "type" => "checkbox",
                        "value" => true
                    ],
                    "helpText" => [
                        "label" => "component.helpText",
                        "type" => "textarea",
                        "value" => "",
                        "advanced" => true
                    ],
                    "helpTextPlacement" => [
                        "label" => "component.helpTextPlacement",
                        "type" => "select",
                        "value" => [
                            [
                                "value" => "below",
                                "label" => "component.belowInputs",
                                "selected" => true
                            ],
                            [
                                "value" => "above",
                                "label" => "component.aboveInputs",
                                "selected" => false
                            ]
                        ],
                        "advanced" => true
                    ],
                    "width" => [
                        "label" => "component.width",
                        "type" => "input",
                        "value" => "400",
                        "advanced" => true
                    ],
                    "height" => [
                        "label" => "component.height",
                        "type" => "input",
                        "value" => "200",
                        "advanced" => true
                    ],
                    "color" => [
                        "label" => "component.color",
                        "type" => "input",
                        "value" => "black",
                        "advanced" => true
                    ],
                    "clearText" => [
                        "label" => "component.clearText",
                        "type" => "input",
                        "value" => $i18n['clear'],
                        "advanced" => true
                    ],
                    "undoText" => [
                        "label" => "component.undoText",
                        "type" => "input",
                        "value" => $i18n['undo'],
                        "advanced" => true
                    ],
                    "cssClass" => [
                        "label" => "component.cssClass",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true
                    ],
                    "labelClass" => [
                        "label" => "component.labelClass",
                        "type" => "input",
                        "value" => "form-label",
                        "advanced" => true
                    ],
                    "containerClass" => [
                        "label" => "component.containerClass",
                        "type" => "input",
                        "value" => "col-12",
                        "advanced" => true
                    ],
                    "alias" => [
                        "label" => "component.alias",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true
                    ]
                ]
            ],
            [
                "name" => "button",
                "title" => "button.title",
                "fields" => [
                    "id" => [
                        "label" => "component.id",
                        "type" => "input",
                        "value" => "button"
                    ],
                    "inputType" => [
                        "label" => "component.type",
                        "type" => "select",
                        "value" => [
                            [
                                "value" => "submit",
                                "label" => "Submit",
                                "selected" => true
                            ],
                            [
                                "value" => "reset",
                                "label" => "Reset",
                                "selected" => false
                            ],
                            [
                                "value" => "image",
                                "label" => "Image",
                                "selected" => false
                            ],
                            [
                                "value" => "button",
                                "label" => "Button",
                                "selected" => false
                            ]
                        ]
                    ],
                    "buttonText" => [
                        "label" => "component.buttonText",
                        "type" => "input",
                        "value" => $i18n['buttonText']
                    ],
                    "label" => [
                        "label" => "component.label",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true
                    ],
                    "src" => [
                        "label" => "component.src",
                        "type" => "input",
                        "value" => "",
                        "advanced" => true
                    ],
                    "cssClass" => [
                        "label" => "component.cssClass",
                        "type" => "input",
                        "value" => "btn btn-primary",
                        "advanced" => true
                    ],
                    "labelClass" => [
                        "label" => "component.labelClass",
                        "type" => "input",
                        "value" => "form-label",
                        "advanced" => true
                    ],
                    "containerClass" => [
                        "label" => "component.containerClass",
                        "type" => "input",
                        "value" => "col-12",
                        "advanced" => true
                    ],
                    "customAttributes" => [
                        "label" => "component.customAttributes",
                        "type" => "choice",
                        "value" => [
                            ""
                        ],
                        "advanced" => true
                    ],
                    "readOnly" => [
                        "label" => "component.readOnly",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true
                    ],
                    "disabled" => [
                        "label" => "component.disabled",
                        "type" => "checkbox",
                        "value" => false,
                        "advanced" => true
                    ]
                ]

                // Add further components here if your original JSON had more
            ]
        ];

        // After defining $components array
        foreach ($components as &$component) {
            if (in_array($component['name'], ['textarea', 'text'])) {
                // Add show_on_summary field only for textarea and text components
                $component['fields']['show_on_summary'] = [
                    'label' => __('Show on Summary Card'),
                    'type' => 'checkbox',
                    'value' => false,
                    'advanced' => true,
                ];
            }

            // Add icon input to all components
            $component['fields']['icon'] = [
                'label' => __('Icon (FontAwesome class)'),
                'type' => 'input',
                'value' => '',       // default empty, can prefill if desired
                'advanced' => true,
            ];
        }

        // Unset reference
        unset($component);

        // Then return response
        return response()->json($components);

    }


    /**
     * @return string
     */
    public function actionBuilderPhrases(Request $request)
    {
        if (!$request->ajax()) {
            abort(404);
        }

        $i18n = [
            "phrases" => [
                "app.name" => str_replace(' ', '+', config('app.name')),
                "form.name" => __('Form Name'),
                "form.description" => __('Used for identify the form on administration pages.'),
                "form.layout" => __('Form Layout'),
                "form.disabled" => __('Disable form elements'),
                "form.sourceCode" => __('Source Code preview'),
                "form.copy" => __('Copy'),
                "form.copied" => __('Copied!'),
                "form.copyToClipboard" => __('Copy to clipboard'),
                "form.save" => __('Save Form'),
                "form.saving" => __('Saving...'),
                "formSteps.title" => __('Form Steps'),
                "formSteps.id" => __('ID / Name'),
                "formSteps.steps" => __('Steps'),
                "formSteps.progressBar" => __('Progress Bar'),
                "formSteps.noTitles" => __('No Titles'),
                "formSteps.noStages" => __('No Stages'),
                "formSteps.noSteps" => __('No Form Steps'),
                "popover.save" => __('Save'),
                "popover.copy" => __('Copy'),
                "popover.delete" => __('Delete'),
                "popover.cancel" => __('Cancel'),
                "popover.more" => __('More'),
                "popover.show" => __('Show'),
                "popover.choice" => __('Choice'),
                "popover.value" => __('Value'),
                "popover.values" => __('Values'),
                "popover.bulkEditor" => __('Bulk Editor'),
                "popover.image" => __('Image'),
                "popover.images" => __('Images'),
                "popover.attribute" => __('Attribute'),
                "popover.copyID" => __('Copy ID'),
                "tab.fields" => __('Fields'),
                "tab.settings" => __('Settings'),
                "tab.code" => __('Code'),
                "alert.warning" => __('Warning!'),
                "alert.errorSavingData" => __('There was a problem saving data. Please retry later'),
                "alert.unsavedChanges" => __(
                    'YOU HAVE UNSAVED CHANGES! ALL CHANGES IN THE FORM WILL BE LOST!'
                ),
                "alert.confirmToDeleteField" => __(
                    "Are you sure you want to delete this field? If you do, any data associated with this field will be deleted too. If this form has at least one form submission, you should export your data first."
                ),
                "alert.unsplashConnectionError" => __('Error connecting to Unsplash. Please try again after 5 minutes.'),
                "widget.button" => __('Submit'),
                "widget.checkbox" => __('Checkboxes'),
                "widget.date" => __('Date Field'),
                "widget.email" => __('Email Field'),
                "widget.file" => __('File Upload'),
                "widget.heading" => __('Heading'),
                "widget.hidden" => __('Hidden Field'),
                "widget.number" => __('Number Field'),
                "widget.pageBreak" => __('Page Break'),
                "widget.paragraph" => __('Paragraph'),
                "widget.radio" => __('Radio Buttons'),
                "widget.recaptcha" => __('reCaptcha'),
                "widget.selectList" => __('Select List'),
                "widget.snippet" => __('Snippet'),
                "widget.text" => __('Text Field'),
                "widget.textArea" => __('Text Area'),
                "widget.spacer" => __('Spacer'),
                "widget.signature" => __('Signature'),
                "widget.matrix" => __('Matrix Field'),
                "widget.nps" => __('Net Promoter Score'),
                "heading.title" => __('Heading'),
                "paragraph.title" => __('Paragraph'),
                "text.title" => __('Text'),
                "number.title" => __('Number'),
                "date.title" => __('Date'),
                "email.title" => __('Email'),
                "textarea.title" => __('Text Area'),
                "signature.title" => __('Signature'),
                "matrix.title" => __('Matrix'),
                "checkbox.title" => __('Checkbox'),
                "radio.title" => __('Radio'),
                "selectlist.title" => __('Select List'),
                "hidden.title" => __('Hidden'),
                "file.title" => __('File Upload'),
                "snippet.title" => __('Snippet'),
                "recaptcha.title" => __('reCAPTCHA'),
                "pagebreak.title" => __('Page Break'),
                "spacer.title" => __('Spacer'),
                "nps.title" => __('Net Promoter Score'),
                "button.title" => __('Button'),
                "pagebreak.prev" => __('Previous'),
                "pagebreak.next" => __('Next'),
                "component.id" => __('ID / Name'),
                "component.text" => __('Text'),
                "component.inputType" => __('Input Type'),
                "component.type" => __('Type'),
                "component.size" => __('Size'),
                "component.label" => __('Label'),
                "component.question" => __('Question'),
                "component.labels" => __('Labels'),
                "component.enterQuestion" => __('Enter Question'),
                "component.placeholder" => __('Placeholder'),
                "component.required" => __('Required'),
                "component.predefinedValue" => __('Predefined Value'),
                "component.helpText" => __('Help Text'),
                "component.helpTextPlacement" => __('Help Text Placement'),
                "component.prepend" => __('Prepend'),
                "component.append" => __('Append'),
                "component.labelPlacement" => __('Label Placement'),
                "component.fieldSize" => __('Field Size'),
                "component.groupName" => __('Group Name'),
                "component.checkboxes" => __('Checkboxes'),
                "component.radios" => __('Radios'),
                "component.options" => __('Options'),
                "component.accept" => __('Accept'),
                "component.pattern" => __('Pattern'),
                "component.integerPattern" => __('Integer Pattern'),
                "component.numberPattern" => __('Number Pattern'),
                "component.prev" => __('Text of Previous Button'),
                "component.next" => __('Text of Next Button'),
                "component.buttonText" => __('Button Text'),
                "component.src" => __('Image Source'),
                "component.inline" => __('Inline'),
                "component.asButton" => __('As Button'),
                "component.unique" => __('Unique'),
                "component.readOnly" => __('Read Only'),
                "component.integerOnly" => __('Integer Only'),
                "component.minlength" => __('Min Length'),
                "component.maxlength" => __('Max Length'),
                "component.min" => __('Minimum'),
                "component.max" => __('Maximum'),
                "component.step" => __('Step'),
                "component.minNumber" => __('Min number'),
                "component.maxNumber" => __('Max number'),
                "component.stepNumber" => __('Step number'),
                "component.minDate" => __('Min date'),
                "component.maxDate" => __('Max date'),
                "component.minSize" => __('Min Size By File'),
                "component.maxSize" => __('Max Size By File'),
                "component.minFiles" => __('Min Files'),
                "component.maxFiles" => __('Max Files'),
                "component.htmlCode" => __('HTML Code'),
                "component.theme" => __('Theme'),
                "component.belowInputs" => __('Below inputs'),
                "component.aboveInputs" => __('Above inputs'),
                "component.checkDNS" => __('Check DNS'),
                "component.multiple" => __('Multiple'),
                "component.disabled" => __('Disabled'),
                "component.cssClass" => __('CSS Class'),
                "component.inputGroupClass" => __('Input Group CSS Class'),
                "component.labelClass" => __('Label CSS Class'),
                "component.containerClass" => __('Container CSS Class'),
                "component.tableClass" => __('Table CSS Class'),
                "component.questionClass" => __('Question CSS Class'),
                "component.buttonClass" => __('Button CSS Class'),
                "component.alias" => __('Alias'),
                "component.clear" => __('Clear'),
                "component.clearText" => __('Clear Button Text'),
                "component.undo" => __('Undo'),
                "component.undoText" => __('Undo Button Text'),
                "component.color" => __('Color'),
                "component.width" => __('Width'),
                "component.height" => __('Height'),
                "component.questions" => __('Questions'),
                "component.answers" => __('Answers'),
                "component.customAttributes" => __('Custom Attributes'),
                "style.global" => __('Global'),
                "style.background" => __('Background'),
                "style.text" => __('Text'),
                "style.title" => __('Title'),
                "style.spacing" => __('Spacing'),
                "style.form" => __('Form'),
                "style.border" => __('Border'),
                "style.extra" => __('Extra'),
                "style.formGroup" => __('Form Group'),
                "style.formControl" => __('Form Control'),
                "style.size" => __('Size'),
                "style.focusEffect" => __('Focus Effect'),
                "style.button" => __('Button'),
                "style.hoverEffect" => __('Hover Effect'),
                "style.label" => __('Label'),
                "style.placeholder" => __('Placeholder'),
                "style.heading" => __('Heading'),
                "style.paragraph" => __('Paragraph'),
                "style.helpText" => __('Help Text'),
                "style.link" => __('Link'),
                "style.formSteps" => __('Form Steps'),
                "style.others" => __('Others'),
                "style.currentStep" => __('Current Step'),
                "style.succeedStep" => __('Succeed Step'),
                "style.previousButton" => __('"Previous" Button'),
                "style.previousButtonHoverEffect" => __('"Previous" Button Hover Effect'),
                "style.nextButton" => __('"Next" Button'),
                "style.nextButtonHoverEffect" => __('"Next" Button Hover Effect'),
                "style.formAlerts" => __('Form Alerts'),
                "style.successMessage" => __('Success Message'),
                "style.errorMessage" => __('Error Message'),
                "style.fieldValidation" => __('Field Validation'),
                "style.asteriskSymbol" => __('Asterisk Symbol'),
                "style.textMessage" => __('Text Message'),
                "style.field" => __('Field'),
                "style.otherComponents" => __('Other Components'),
                "style.signaturePad" => __('Signature Pad'),
                "style.checkbox" => __('Checkbox'),
                "style.input" => __('Input'),
                "style.customControl" => __('Custom Control'),
                "style.checked" => __('Checked'),
                "style.mark" => __('Mark'),
                "style.radioButton" => __('Radio Button'),
                "style.gradients" => __('Gradients'),
                "style.patterns" => __('Patterns'),
                "style.none" => __('None'),
                "style.type" => __('Type'),
                "style.radial" => __('Radial'),
                "style.linear" => __('Linear'),
                "style.repeatingRadial" => __('Repeating Radial'),
                "style.repeatingLinear" => __('Repeating Linear'),
                "style.direction" => __('Direction'),
                "style.top" => __('Top'),
                "style.right" => __('Right'),
                "style.center" => __('Center'),
                "style.bottom" => __('Bottom'),
                "style.left" => __('Left'),
                "style.backgroundColor" => __('Background Color'),
                "style.selectColor" => __('Select color...'),
                "style.color" => __('Color'),
                "style.backgroundImageGradient" => __('Background Image / Gradient'),
                "style.bgSize" => __('BG Size'),
                "style.bgRepeat" => __('BG Repeat'),
                "style.backgroundPosition" => __('Background Position'),
                "style.borderStyle" => __('Border Style'),
                "style.borderWidth" => __('Border Width'),
                "style.borderColor" => __('Border Color'),
                "style.borderRadius" => __('Border Radius'),
                "style.boxShadow" => __('Box Shadow'),
                "style.textShadow" => __('Text Shadow'),
                "style.basic" => __('Basic'),
                "style.hard" => __('Hard'),
                "style.double" => __('Double'),
                "style.downAndDistant" => __('Down and Distant'),
                "style.closeAndHeavy" => __('Close and Heavy'),
                "style.glowing" => __('Glowing'),
                "style.superhero" => __('Superhero'),
                "style.multipleLightSources" => __('Multiple Light Sources'),
                "style.softEmboss" => __('Soft Emboss'),
                "style.margin" => __('Margin'),
                "style.padding" => __('Padding'),
                "style.width" => __('Width'),
                "style.height" => __('Height'),
                "style.float" => __('Float'),
                "style.textAlignment" => __('Text Alignment'),
                "style.fontFamily" => __('Font Family'),
                "style.selectFont" => __('Select font...'),
                "style.fontSize" => __('Font Size'),
                "style.fontWeight" => __('Font Weight'),
                "style.textTransform" => __('Text Transform'),
                "style.textDecoration" => __('Text Decoration'),
                "style.lineHeight" => __('Line Height'),
                "style.letterSpacing" => __('Letter Spacing'),
                "style.transition" => __('Transition'),
                "style.display" => __('Display'),
                "style.choose" => __('Choose'),
                "style.cancel" => __('Cancel'),
                "style.inputGroup" => __('Input Group'),
                "style.prependAppend" => __('Prepend & Append'),
                "style.append" => __('Append'),
                "style.progressBar" => __('Progress Bar'),
                "style.progressBarContainer" => __('Progress Bar Container'),
                "style.images" => __('Images'),
                "style.searchImages" => __('Search Images'),
                "style.latest" => __('Latest'),
                "style.oldest" => __('Oldest'),
                "style.popular" => __('Popular'),
                "style.noResultsFound" => __('No Results Found'),


            ]
        ];

        return response()->json($i18n);

    }

    public function initForm(Request $request, $id = null, $template = 'default')
    {
        if (!$request->ajax()) {
            return response()->json('', 400);
        }

        $i18n = [
            'untitledForm' => __('Untitled Form'),
            'thisIsMyForm' => __('This is my form. Please fill it out. Thanks!'),
        ];

        $defaultJson = <<<EOD
{
    "initForm": [
        {
            "name": "heading",
            "title": "heading.title",
            "fields": {
                "id": {
                    "label": "component.id",
                    "type": "input",
                    "value": "heading_0"
                },
                "text": {
                    "label": "component.text",
                    "type": "input",
                    "value": "{$i18n['untitledForm']}"
                },
                "type": {
                    "label": "component.type",
                    "type": "select",
                    "value": [
                        {"value": "h1", "label": "H1", "selected": true},
                        {"value": "h2", "label": "H2", "selected": false},
                        {"value": "h3", "label": "H3", "selected": false},
                        {"value": "h4", "label": "H4", "selected": false},
                        {"value": "h5", "label": "H5", "selected": false},
                        {"value": "h6", "label": "H6", "selected": false}
                    ]
                },
                "cssClass": {
                    "label": "component.cssClass",
                    "type": "input",
                    "value": "",
                    "advanced": true
                },
                "containerClass": {
                    "label": "component.containerClass",
                    "type": "input",
                    "value": "",
                    "advanced": true
                }
            },
            "fresh": false
        },
        {
            "name": "paragraph",
            "title": "paragraph.title",
            "fields": {
                "id": {
                    "label": "component.id",
                    "type": "input",
                    "value": "paragraph_0"
                },
                "text": {
                    "label": "component.text",
                    "type": "textarea",
                    "value": "{$i18n['thisIsMyForm']}"
                },
                "cssClass": {
                    "label": "component.cssClass",
                    "type": "input",
                    "value": "",
                    "advanced": true
                },
                "containerClass": {
                    "label": "component.containerClass",
                    "type": "input",
                    "value": "",
                    "advanced": true
                }
            },
            "fresh": false
        }
    ],
    "settings": {
        "name": "{$i18n['untitledForm']}",
        "canvas": "#canvas",
        "disabledFieldset": false,
        "layoutSelected": "",
        "layouts": [
            {"id": "", "name": "Vertical"},
            {"id": "form-horizontal", "name": "Horizontal"},
            {"id": "form-inline", "name": "Inline"}
        ],
        "formSteps": {
            "title": "formSteps.title",
            "fields": {
                "id": {
                    "label": "formSteps.id",
                    "type": "input",
                    "value": "formSteps"
                },
                "steps": {
                    "label": "formSteps.steps",
                    "type": "textarea-split",
                    "value": []
                },
                "progressBar": {
                    "label": "formSteps.progressBar",
                    "type": "checkbox",
                    "value": false
                },
                "noTitles": {
                    "label": "formSteps.noTitles",
                    "type": "checkbox",
                    "value": false
                },
                "noStages": {
                    "label": "formSteps.noStages",
                    "type": "checkbox",
                    "value": false
                },
                "noSteps": {
                    "label": "formSteps.noSteps",
                    "type": "checkbox",
                    "value": false
                }
            }
        }
    }
}
EOD;

        $json = $defaultJson;

        if (is_null($id)) { // Create form case

            if ($template !== 'default') {
                $templateModel = Template::where('slug', $template)->first();

                if (!$templateModel || Gate::denies('viewTemplates', $templateModel)) {
                    abort(403, __('Invalid template.'));
                }

                $json = $templateModel->builder;
            }

        } else { // Update form case

            $formModel = Form::findOrFail($id);

            // You might want to check permissions here too:
            // Gate::authorize('view', $formModel);

            if ($formModel && $formModel->formData && $formModel->formData->builder) {
                $json = $formModel->formData->builder;
            }
        }

        return response()->json(json_decode($json, true));
    }

    public function createForm(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json('', 400);
        }

        $data = $request->input('FormBuilder');

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => __('No form data received.'),
            ]);
        }

        // Validate basic structure - customize your validation rules as needed
        $validator = Validator::make(['FormBuilder' => $data], [
            'FormBuilder' => 'required|json',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ]);
        }

        $decodedData = json_decode($data, true);

        $success = false;
        $id = false;
        $message = '';
        $code = 0;

        DB::beginTransaction();

        try {
            // Parse html form fields - assuming you have a FormDOM helper like in Yii
            $formDOM = new FormDOM();
            $formDOM->loadHTML($decodedData['html']);
            $formDOM->loadXpath();
            $formDOM->loadFields();

            // Filter reCaptcha component if present
            $reCaptchaComponent = array_filter($decodedData['data']['initForm'] ?? [], function ($item) {
                return isset($item['name']) && $item['name'] === 'recaptcha';
            });

            // Update form name with form title
            $name = $decodedData['data']['settings']['name'] ?? __('Untitled Form');

            if ($name === __('Untitled Form')) {
                $name = $formDOM->getFormTitle();
                $decodedData['data']['settings']['name'] = $name;
            }

            // Create Form model
            $formModel = new Form();
            $formModel->name = $name;
            $formModel->language = app()->getLocale();
            $formModel->recaptcha = count($reCaptchaComponent) > 0 ? 1 : 0;

            if (!$formModel->save()) {
                Log::error('Error creating form model: ' . json_encode($formModel->errors()));
                throw new Exception(__('Error saving data'));
            }

            $id = $formModel->id;

            // Save FormData model
            $formDataModel = new FormData();
            $formDataModel->form_id = $id;
            $formDataModel->builder = json_encode($decodedData['data'], JSON_UNESCAPED_UNICODE);
            $formDataModel->fields = json_encode($formDOM->getFieldsAsJSON());
            $formDataModel->html = e($decodedData['html']);
            $formDataModel->height = (int) ($decodedData['data']['height'] ?? 0);

            if (!$formDataModel->save()) {
                Log::error('Error creating form data model: ' . json_encode($formDataModel->errors()));
                throw new Exception(__('Error saving data'));
            }

            // Save related models and link them to the form
            $formUIModel = new FormUI();
            $formUIModel->form()->associate($formModel);
            $formUIModel->save();

            $formConfirmationModel = new FormConfirmation();
            $formConfirmationModel->form()->associate($formModel);
            $formConfirmationModel->save();

            $formEmailModel = new FormEmail();
            $formEmailModel->form()->associate($formModel);
            $formEmailModel->save();

            DB::commit();

            $success = true;
            $message = __('The form has been successfully created.');

        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e);
            $message = $e->getMessage();
            $code = $e->getCode();
        }

        return response()->json([
            'success' => $success,
            'id' => $id,
            'action' => 'create',
            'message' => $message,
            'code' => $code,
        ]);
    }

}
