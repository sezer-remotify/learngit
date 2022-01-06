<?php

// Button (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Button", 'quanto'),
        "base" => "otbutton",
        "class" => "",
        "category" => 'Quanto Element',
        "icon" => "icon-st",
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-6",
                "heading" => esc_html__("Button Text", 'quanto'),
                "param_name" => "btn_text",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-6",
                "heading" => esc_html__("Button Link", 'quanto'),
                "param_name" => "btn_link",
                "value" => "",
            ),
            array(
                "type" => "iconpicker",
                "holder" => "div",
                "class" => "",
                "edit_field_class" => "vc_col-sm-6",
                "heading" => esc_html__("Icon", 'quanto'),
                "param_name" => "icon",
                "value" => "",
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-6",
                "heading" => esc_html__("Size", 'quanto'),
                "param_name" => "size",
                "value" => array(
                    esc_html__('Default', 'quanto')    => '',
                    esc_html__('Small', 'quanto')    => 'btn-xs',
                    esc_html__('Medium', 'quanto')   => 'btn-sm',
                    esc_html__('Large', 'quanto')    => 'btn-lg',
                    esc_html__('Block', 'quanto')    => 'btn-block',
                ),
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-6",
                "heading" => esc_html__("Shape", 'quanto'),
                "param_name" => "type",
                "value" => array(
                    esc_html__('Rounded', 'quanto')     => 'btn-rounded',
                    esc_html__('Rounded Left', 'quanto')   => 'btn-rounded-left',
                    esc_html__('Rounded Right', 'quanto')   => 'btn-rounded-right',
                    esc_html__('Square', 'quanto')   => 'btn-square',
                ),
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-6",
                "heading" => esc_html__("Style", 'quanto'),
                "param_name" => "style",
                "value" => array(
                    esc_html__('Primary', 'quanto') => 'btn-primary',
                    esc_html__('White', 'quanto') => 'btn-white',
                    esc_html__('Secondary', 'quanto')      => 'btn-secondary',
                    esc_html__('Brand', 'quanto')      => 'btn-brand',
                    esc_html__('Success', 'quanto')   => 'btn-success',
                    esc_html__('Danger', 'quanto')   => 'btn-danger',
                    esc_html__('Warning', 'quanto')   => 'btn-warning',
                    esc_html__('Info', 'quanto')   => 'btn-info',
                    esc_html__('Light', 'quanto')   => 'btn-light',
                    esc_html__('Dark', 'quanto')   => 'btn-dark',
                    esc_html__('Custom', 'quanto')      => 'btn-custom',
                ),
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => esc_html__("Type Outline", 'quanto'),
                "edit_field_class" => "vc_col-sm-6",
                "param_name" => "outline",
                "value" => array(
                    esc_html__('None', 'quanto')     => 'btn-none-outline',
                    esc_html__('Outline Primary', 'quanto')   => 'btn-outline-primary',
                    esc_html__('Outline Brand', 'quanto')   => 'btn-outline-brand',
                    esc_html__('Outline Secondary', 'quanto')   => 'btn-outline-secondary',
                    esc_html__('Outline Success', 'quanto')   => 'btn-outline-success',
                    esc_html__('Outline Danger', 'quanto')   => 'btn-outline-danger',
                    esc_html__('Outline Warning', 'quanto')   => 'btn-outline-warning',
                    esc_html__('Outline Info', 'quanto')   => 'btn-outline-info',
                    esc_html__('Outline Light', 'quanto')   => 'btn-outline-light',
                    esc_html__('Outline Dark', 'quanto')   => 'btn-outline-dark',
                ),
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => esc_html__("Align", 'quanto'),
                "edit_field_class" => "vc_col-sm-6",
                "param_name" => "align",
                "value" => array(
                    esc_html__('Left', 'quanto')     => 'text-left',
                    esc_html__('Center', 'quanto')   => 'text-center',
                    esc_html__('Right', 'quanto')    => 'text-right',
                ),
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Color Text", 'quanto'),
                "param_name" => "color",
                "dependency"  => array( 'element' => 'style', 'value' => 'btn-custom' ),
                "value" => "",
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "heading" => esc_html__("Backgound Color", 'quanto'),
                "param_name" => "bg_color",
                "dependency"  => array( 'element' => 'style', 'value' => 'btn-custom' ),
                "value" => "",
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Border Color", 'quanto'),
                "param_name" => "bo_color",
                "dependency"  => array( 'element' => 'style', 'value' => 'btn-custom' ),
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

//Subheader Section (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Subheader Section", 'quanto'),
        "base" => "ot_subheader",
        "class" => "",
        "category" => 'Quanto Element',
        "params" => array(
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Style', 'quanto'),
                "param_name" => "style",
                "value" => array(
                    esc_html__('Style 1', 'quanto')   => 'style1',
                    esc_html__('Style 2', 'quanto')   => 'style2',
                    esc_html__('Style 3', 'quanto')   => 'style3',
                    esc_html__('Style 4', 'quanto')   => 'style4',
                    esc_html__('Style 5', 'quanto')   => 'style5',
                ),
            ),
            array(
                "type" => "attach_image",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Background Overlay Image', 'quanto'),
                "param_name" => "bgimage",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Title', 'quanto'),
                "param_name" => "title",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Subtitle", 'quanto'),
                "param_name" => "stitle",
                "value" => '',
            ),
            array(
                "type" => "textarea_html",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Content", 'quanto'),
                "param_name" => "content",
                "value" => '',
            ),
            array(
                "type" => "vc_link",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Link', 'quanto'),
                "param_name" => "link",
                "value" => "",
            ),
            array(
                "type" => "attach_image",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Right Image', 'quanto'),
                "param_name" => "image",
                "value" => "",
            ),
            array(
                "type" => "checkbox",
                "holder" => "div",
                "class" => "",
                "dependency"  => array( 'element' => 'style', 'value' => 'style1' ),
                "heading" => esc_html__('Rating', 'quanto'),
                "param_name" => "rating",
                "value" => "",
            ),
            array(
                'type' => 'dropdown',
                'value' => '',
                'heading' => esc_html__('Rate?', 'quanto'),
                'param_name' => 'review',
                "dependency"  => array( 'element' => 'style', 'value' => 'style1' ),
                "dependency"  => array( 'element' => 'rating', 'value' => 'true' ),
                "value" => array(
                    esc_html__('5 Star', 'quanto')   => '5star',
                    esc_html__('4.5 Star', 'quanto')   => '4s-half',
                    esc_html__('4 Star', 'quanto')   => '4star',
                    esc_html__('3.5 Star', 'quanto')   => '3s-half',
                    esc_html__('3 Star', 'quanto')   => '3star',
                    esc_html__('2.5 Star', 'quanto')   => '2s-half',
                    esc_html__('2 Star', 'quanto')   => '2star',
                    esc_html__('1.5 Star', 'quanto')   => '1s-half',
                    esc_html__('1 Star', 'quanto')   => '1star',
                    esc_html__('Half Star', 'quanto')   => 'half',
                ),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "dependency"  => array( 'element' => 'rating', 'value' => 'true' ),
                "class" => "",
                "dependency"  => array( 'element' => 'style', 'value' => 'style1' ),
                "heading" => esc_html__('Review Text', 'quanto'),
                "param_name" => "review_text",
                "value" => "",
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Pattern Bottom', 'quanto'),
                "dependency"  => array( 'element' => 'style', 'value' => 'style1' ),
                "param_name" => "pattern",
                "value" => array(
                    esc_html__('None', 'quanto')   => '',
                    esc_html__('Style 1', 'quanto')   => 'pattern1',
                    esc_html__('Style 2', 'quanto')   => 'pattern2',
                ),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Extra Class', 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            )
        )
    ));
}

// Home Slider (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Home Slider", 'quanto'),
        "base" => "homelide",
        "class" => "",
        "category" => 'Quanto Element',
        "params" => array(
            array(
                'type' => 'param_group',
                'heading' => esc_html__("Slider", 'quanto'),
                'value' => '',
                'param_name' => 'slide',
                // Note params is mapped inside param-group:
                'params' => array(
                    array(
                        'type' => 'attach_image',
                        'value' => '',
                        'heading' => 'Background Image',
                        'param_name' => 'photo',
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        'value' => '',
                        'heading' => esc_html__('Title', 'quanto'),
                        'param_name' => 'title',
                    ),
                    array(
                        'type' => 'textarea',
                        "holder" => "div",
                        'value' => '',
                        'heading' => esc_html__('Subtitle', 'quanto'),
                        'param_name' => 'stitle',
                    ),
                    array(
                        'type' => 'textfield',
                        'value' => '',
                        "edit_field_class" => "vc_col-sm-6",
                        'heading' => esc_html__('Button Text', 'quanto'),
                        'param_name' => 'btext',
                    ),
                    array(
                        'type' => 'textfield',
                        'value' => '',
                        "edit_field_class" => "vc_col-sm-6",
                        'heading' => esc_html__('Button Link', 'quanto'),
                        'param_name' => 'blink',
                    ),
                    array(
                        "type" => "dropdown",
                        "holder" => "div",
                        "heading" => esc_html__("Offset Column", 'quanto'),
                        "param_name" => "colof",
                        "value" => array(
                            esc_html__('No Offset', 'quanto') => 'none',
                            esc_html__('1 Column', 'quanto') => '1',
                            esc_html__('2 Column', 'quanto') => '2',
                            esc_html__('3 Column', 'quanto') => '3',
                            esc_html__('4 Column', 'quanto') => '4',
                            esc_html__('5 Column', 'quanto') => '5',
                            esc_html__('6 Column', 'quanto') => '6',
                        ),
                    ),
                )
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

// Slick Slider (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Slick Slider", 'quanto'),
        "base" => "slicklide",
        "class" => "",
        "category" => 'Quanto Element',
        "params" => array(
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => esc_html__("Style", 'quanto'),
                "param_name" => "style",
                "value" => array(
                    esc_html__('Style 1', 'quanto') => 'style1',
                    esc_html__('Style 2 ', 'quanto') => 'style2',
                ),
            ),
            array(
                'type' => 'param_group',
                'heading' => esc_html__("Slider", 'quanto'),
                'value' => '',
                'param_name' => 'slide',
                "dependency"  => array( 'element' => 'style', 'value' => 'style1' ),
                // Note params is mapped inside param-group:
                'params' => array(
                    array(
                        'type' => 'attach_image',
                        'value' => '',
                        'heading' => 'Background Image',
                        'param_name' => 'photo',
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        'value' => '',
                        'heading' => esc_html__('Navigation text', 'quanto'),
                        'param_name' => 'navtext',
                    ),
                )
            ),
            array(
                'type' => 'param_group',
                'heading' => esc_html__("Slider", 'quanto'),
                'value' => '',
                'param_name' => 'slide2',
                "dependency"  => array( 'element' => 'style', 'value' => 'style2' ),
                // Note params is mapped inside param-group:
                'params' => array(
                    array(
                        'type' => 'attach_image',
                        'value' => '',
                        'heading' => 'Background Image',
                        'param_name' => 'photo',
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        'value' => '',
                        'heading' => esc_html__('Title', 'quanto'),
                        'param_name' => 'title',
                    ),
                    array(
                        'type' => 'textarea',
                        "holder" => "div",
                        'value' => '',
                        'heading' => esc_html__('Subtitle', 'quanto'),
                        'param_name' => 'stitle',
                    ),
                    array(
                        'type' => 'vc_link',
                        'heading' => esc_html__('Link', 'quanto'),
                        'param_name' => 'link',
                    ),
                )
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Auto play", 'quanto'),
                "param_name" => "auto",
                "value" => "",
            ),
            array(
                "type" => "checkbox",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Arrow", 'quanto'),
                "value" => array(
                    esc_html__('True', 'quanto') => 'true',
                    esc_html__('False ', 'quanto') => 'false',
                ),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

// Search Section (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Search Section", 'quanto'),
        "base" => "searchsec",
        "class" => "",
        "category" => 'Quanto Element',
        "icon" => "icon-st",
        "params" => array(
            array(
                "type" => "attach_image",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Background Image", 'quanto'),
                "param_name" => "photo",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Title', 'quanto'),
                "param_name" => "title",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Placeholder field search", 'quanto'),
                "param_name" => "placeholder",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Button text", 'quanto'),
                "param_name" => "btn",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

// Counter (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Counter", 'quanto'),
        "base" => "counter",
        "class" => "",
        "category" => 'Quanto Element',
        "icon" => "icon-st",
        "params" => array(
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => esc_html__("Style", 'quanto'),
                "param_name" => "style",
                "value" => array(
                    esc_html__('Style 1', 'quanto') => 'style1',
                    esc_html__('Style 2 (text white)', 'quanto') => 'style2',
                    esc_html__('Style 3 (text black)', 'quanto') => 'style3',
                    esc_html__('Style 4 (Not text after number)', 'quanto') => 'style4',
                    esc_html__('Style 5 (style icon)', 'quanto') => 'style5',
                    esc_html__('Style 6 (simple white)', 'quanto') => 'style6',
                    esc_html__('Style 7 (Box)', 'quanto') => 'style7',
                ),
            ),
            array(
                "type" => "iconpicker",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Icon', 'quanto'),
                "param_name" => "icon",
                "dependency"  => array( 'element' => 'style', 'value' => array('style1','style5') ),
                "value" => "",
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Color', 'quanto'),
                "param_name" => "color",
                "dependency"  => array( 'element' => 'style', 'value' => 'style7' ),
                "value" => "",
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Background Color', 'quanto'),
                "param_name" => "bg_color",
                "dependency"  => array( 'element' => 'style', 'value' => 'style7' ),
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Title', 'quanto'),
                "param_name" => "title",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Text Block", 'quanto'),
                "param_name" => "desc",
                "dependency"  => array( 'element' => 'style', 'value' => 'style1' ),
                "value" => '',
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Number Start', 'quanto'),
                "param_name" => "start",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Number Count', 'quanto'),
                "param_name" => "number",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Text Number Count', 'quanto'),
                "param_name" => "after",
                "dependency"  => array( 'element' => 'style', 'value' => array('style2','style3','style7') ),
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

// Pricing Table (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Pricing Table", 'quanto'),
        "base" => "pricing",
        "class" => "",
        "category" => 'Quanto Element',
        "icon" => "icon-st",
        "params" => array(
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Style", 'quanto'),
                "param_name" => "style",
                "value" => array(
                    esc_html__('Style 1', 'quanto')    => 'style1',
                    esc_html__('Style 2', 'quanto')    => 'style2',
                    esc_html__('Style 3', 'quanto')    => 'style3',
                    esc_html__('Style 4', 'quanto')    => 'style4',
                    esc_html__('Style 5', 'quanto')    => 'style5',
                    esc_html__('Style 6', 'quanto')    => 'style6',
                    esc_html__('Style 7', 'quanto')    => 'style7',
                ),
            ),
            array(
                "type" => "attach_image",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Image', 'quanto'),
                "param_name" => "image",
                "dependency"  => array( 'element' => 'style', 'value' => array('style5','style6') ),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Title', 'quanto'),
                "param_name" => "title",
                "value" => "",
            ),
            array(
                "type" => "textarea",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Subtitle', 'quanto'),
                "param_name" => "stitle",
                "dependency"  => array( 'element' => 'style', 'value' => array('style1','style2','style3','style6','style7') ),
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Price Label', 'quanto'),
                "param_name" => "plabel",
                "dependency"  => array( 'element' => 'style', 'value' => 'style3' ),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Price', 'quanto'),
                "param_name" => "price",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Per', 'quanto'),
                "param_name" => "per",
                "dependency"  => array( 'element' => 'style', 'value' => array('style3','style4','style7') ),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Currency', 'quanto'),
                "param_name" => "currency",
                "dependency"  => array( 'element' => 'style', 'value' => 'style7' ),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Info Rate', 'quanto'),
                "param_name" => "rate",
                "dependency"  => array( 'element' => 'style', 'value' => 'style2' ),
            ),
            array(
                "type" => "textarea_html",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Content", 'quanto'),
                "param_name" => "content",
                "dependency"  => array( 'element' => 'style', 'value' => array('style1','style2','style4','style5','style6','style7') ),
                "value" => '',
            ),
            array(
                "type" => "vc_link",
                "holder" => "div",
                "class" => "",
                "dependency"  => array( 'element' => 'style', 'value' => array('style1','style2','style4','style5','style6','style7') ),
                "heading" => esc_html__("Link", 'quanto'),
                "param_name" => "link",
                "value" => '',
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

//Pricing Features Box (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Pricing Features Box", 'quanto'),
        "base" => "featuresbox",
        "class" => "",
        "category" => 'Quanto Element',
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Icon", 'quanto'),
                "param_name" => "icon",
                "description" => __("Ex: icon-003-id-card. Find here <a target='_blank' href='http://wpdemo2.oceanthemes.net/quanto/flat-icon/'>http://wpdemo2.oceanthemes.net/quanto/flat-icon/</a>.",'quanto')
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Title", 'quanto'),
                "param_name" => "title",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Subtitle", 'quanto'),
                "param_name" => "stitle",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Price", 'quanto'),
                "param_name" => "price",
            ),
            array(
                "type" => "checkbox",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Active Box", 'quanto'),
                "param_name" => "check",
            ),
            array(
                'type' => 'vc_link',
                "heading" => esc_html__("Button", 'quanto'),
                "param_name" => "link",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
            ),
        )));
}

//Image Box Box (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Image Box", 'quanto'),
        "base" => "imgbox",
        "class" => "",
        "category" => 'Quanto Element',
        "params" => array(
            array(
                "type" => "dropdown",
                "heading" => esc_html__('Style', 'quanto'),
                "param_name" => "style",
                "value" => array(
                    esc_html__('Style 1', 'quanto')     => 'style1',
                    esc_html__('Style 2', 'quanto')     => 'style2',
                    esc_html__('Style 3', 'quanto')     => 'style3',
                ),
            ),
            array(
                "type" => "attach_image",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Image", 'quanto'),
                "param_name" => "photo",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Title", 'quanto'),
                "param_name" => "title",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Subtitle", 'quanto'),
                "dependency"  => array( 'element' => 'style', 'value' => 'style3' ),
                "param_name" => "stitle",
            ),
            array(
                "type" => "textarea_html",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Content", 'quanto'),
                "dependency"  => array( 'element' => 'style', 'value' => array('style1','style3') ),
                "param_name" => "content",
            ),
            array(
                'type' => 'vc_link',
                "heading" => esc_html__("Button", 'quanto'),
                "dependency"  => array( 'element' => 'style', 'value' => array('style1','style3') ),
                "param_name" => "link",
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__('Pattern', 'quanto'),
                "dependency"  => array( 'element' => 'style', 'value' => 'style1' ),
                "param_name" => "pattern",
                "value" => array(
                    esc_html__('Pattern Left Bottom', 'quanto')     => 'card-pattern-left',
                    esc_html__('Pattern Left Top', 'quanto')     => 'card-pattern-left-top',
                    esc_html__('Pattern Right Bottom', 'quanto')     => 'card-pattern-right',
                    esc_html__('Pattern Right Top', 'quanto')     => 'card-pattern-right-top',
                    esc_html__('Pattern Bottom', 'quanto')     => 'card-pattern-bottom',
                    esc_html__('Pattern Top', 'quanto')     => 'card-pattern-top',
                    esc_html__('Pattern Full', 'quanto')     => 'card-pattern-full',
                ),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
            ),
        )));
}

//Mortgage Feature Box (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Mortgage Feature Box", 'quanto'),
        "base" => "mortftb",
        "class" => "",
        "category" => 'Quanto Element',
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Title", 'quanto'),
                "param_name" => "title",
            ),
            array(
                "type" => "textarea_html",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Content", 'quanto'),
                "param_name" => "content",
            ),
            array(
                'type' => 'vc_link',
                "heading" => esc_html__("Button", 'quanto'),
                "param_name" => "link",
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__('Pattern', 'quanto'),
                "param_name" => "pattern",
                "dependency"  => array( 'element' => 'style', 'value' => 'style2' ),
                "value" => array(
                    esc_html__('None', 'quanto')     => 'none',
                    esc_html__('Pattern Bottom', 'quanto')     => 'card-pattern-bottom',
                    esc_html__('Pattern Top', 'quanto')     => 'card-pattern-top',
                    esc_html__('Pattern Left Bottom', 'quanto')     => 'card-pattern-left',
                    esc_html__('Pattern Left Top', 'quanto')     => 'card-pattern-left-top',
                    esc_html__('Pattern Right Bottom', 'quanto')     => 'card-pattern-right',
                    esc_html__('Pattern Right Top', 'quanto')     => 'card-pattern-right-top',
                    esc_html__('Pattern Full', 'quanto')     => 'card-pattern-full',
                ),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
            ),
        )));
}

//Bank Service (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Bank Service", 'quanto'),
        "base" => "banksv",
        "class" => "",
        "category" => 'Quanto Element',
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Title", 'quanto'),
                "param_name" => "title",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Price For Service", 'quanto'),
                "param_name" => "price",
            ),
            array(
                'type' => 'vc_link',
                "heading" => esc_html__("Button", 'quanto'),
                "param_name" => "link",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
            ),
        )));
}

//Bank Feature (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Bank Features", 'quanto'),
        "base" => "bankft",
        "class" => "",
        "category" => 'Quanto Element',
        "params" => array(
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Image Position", 'quanto'),
                "param_name" => "img_post",
                "value" => array(
                    esc_html__('Image Left', 'quanto')    => 'left',
                    esc_html__('Image Right', 'quanto')    => 'right',
                ),
            ),
            array(
                "type" => "attach_image",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Image", 'quanto'),
                "param_name" => "image",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Title", 'quanto'),
                "param_name" => "title",
            ),
            array(
                "type" => "textarea_html",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Content", 'quanto'),
                "param_name" => "content",
            ),
            array(
                'type' => 'vc_link',
                "heading" => esc_html__("Button", 'quanto'),
                "param_name" => "link",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
            ),
        )));
}

//Basic Table (quanto)
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Basic Table", 'quanto'),
   "base" => "basictable",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Quanto Element',
   "params" => array(
      array(
        "type"        => 'textarea',
        "holder"      => 'div',
        "heading"     => esc_html__('Titles','quanto'),
        "param_name"  => 'titles',
        "value"       => '',
        "description" => esc_html__("Enter titles for element (Note: divide columns with '|').",'quanto')
      ),
      array(
        "type"        => 'textarea_html',
        "holder"      => 'div',
        "heading"     => esc_html__('Content','quanto'),
        "param_name"  => 'content',
        'value'       => '',
        "description" => esc_html__("Enter the content ( Note: divide columns with '|' and devide rows with linebreaks (Enter)).",'quanto')
      ),
      array(
        'type'        => 'textfield',
        'holder'      => 'div',
        'heading'     => esc_html__( 'Extra class name', 'quanto' ),
        'param_name'  => 'class_name',
        'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file. Some classes are available as: "thead-dark","thead-light","table-striped","table-bordered", "table-borderless table-dark", "table-hover", "bank-compare-table" ', 'quanto' ),
      ),
    )));
}

//Data Table (quanto)
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__("OT Data Table", 'quanto'),
   "base" => "datatable",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Quanto Element',
   "params" => array(
      array(
        "type"        => 'textarea',
        "holder"      => 'div',
        "heading"     => esc_html__('Titles','quanto'),
        "param_name"  => 'titles',
        "value"       => '',
        "description" => esc_html__("Enter titles for element (Note: divide columns with '|').",'quanto')
      ),
      array(
        "type"        => 'textarea_html',
        "holder"      => 'div',
        "heading"     => esc_html__('Content','quanto'),
        "param_name"  => 'content',
        'value'       => '',
        "description" => esc_html__("Enter the content ( Note: divide columns with '|' and devide rows with linebreaks (Enter)).",'quanto')
      ),
      array(
        "type"        => 'textarea',
        "holder"      => 'div',
        "heading"     => esc_html__('Titles Footer','quanto'),
        "param_name"  => 'ftitles',
        "value"       => '',
        "description" => esc_html__("Enter titles for element (Note: divide columns with '|').",'quanto')
      ),
      array(
        'type'        => 'textfield',
        'holder'      => 'div',
        'heading'     => esc_html__( 'Extra class name', 'quanto' ),
        'param_name'  => 'class_name',
        'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'quanto' ),
      ),
    )));
}

// Feature Box (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Feature Box", 'quanto'),
        "base" => "feature",
        "class" => "",
        "category" => 'Quanto Element',
        "icon" => "icon-st",
        "params" => array(
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => esc_html__("Style", 'quanto'),
                "param_name" => "style",
                "value" => array(
                    esc_html__('Style 1', 'quanto') => 'style1',
                    esc_html__('Style 2', 'quanto') => 'style2',
                    esc_html__('Style 3', 'quanto') => 'style3',
                    esc_html__('Style 4', 'quanto') => 'style4',
                    esc_html__('Style 5', 'quanto') => 'style5',
                    esc_html__('Style 6', 'quanto') => 'style6',
                    esc_html__('Style 7', 'quanto') => 'style7',
                    esc_html__('Style 8', 'quanto') => 'style8',
                    esc_html__('Style 9', 'quanto') => 'style9',
                    esc_html__('Style 10', 'quanto') => 'style10',
                ),
            ),
            array(
                "type" => "iconpicker",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Icon', 'quanto'),
                "param_name" => "icon",
                "dependency"  => array( 'element' => 'style', 'value' => array('style1','style3','style5','style6','style8','style9','style10') ),
                "value" => "",
            ),
            array(
                "type" => "attach_image",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Icon Image', 'quanto'),
                "param_name" => "image",
                "dependency"  => array( 'element' => 'style', 'value' => 'style4' ),
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Icon', 'quanto'),
                "param_name" => "iconfl",
                "dependency"  => array( 'element' => 'style', 'value' => array('style2','style7') ),
                "value" => "",
                "description" => __("Ex: icon-003-id-card. Find here <a target='_blank' href='http://wpdemo2.oceanthemes.net/quanto/flat-icon/'>http://wpdemo2.oceanthemes.net/quanto/flat-icon/</a>.",'quanto')
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Color Icon', 'quanto'),
                "param_name" => "color",
                "dependency"  => array( 'element' => 'style', 'value' => array('style7','style9','style10') ),
                "value" => "",
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Backfround Color Icon', 'quanto'),
                "param_name" => "bg_color",
                "dependency"  => array( 'element' => 'style', 'value' => array('style7','style9','style10') ),
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Title', 'quanto'),
                "param_name" => "title",
                "value" => "",
            ),
            array(
                "type" => "textarea_html",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Content", 'quanto'),
                "param_name" => "content",
                "value" => '',
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => esc_html__("Button Style", 'quanto'),
                "dependency"  => array( 'element' => 'style', 'value' => 'style2' ),
                "param_name" => "btnst",
                "value" => array(
                    esc_html__('Style Text Link', 'quanto') => 'btn-primary-arrow-link',
                    esc_html__('Style Secondary', 'quanto') => 'btn btn-rounded btn-secondary',
                    esc_html__('Style Brand', 'quanto') => 'btn btn-rounded btn-brand',
                ),
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => esc_html__("Arrow Right Button", 'quanto'),
                "dependency"  => array( 'element' => 'style', 'value' => 'style2' ),
                "param_name" => "arrow",
                "value" => array(
                    esc_html__('No', 'quanto') => 'no',
                    esc_html__('Yes', 'quanto') => 'yes',
                ),
            ),
            array(
                "type" => "vc_link",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Link", 'quanto'),
                "param_name" => "link",
                "dependency"  => array( 'element' => 'style', 'value' => array('style2','style4','style7','style10') ),
                "value" => '',
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__('Pattern', 'quanto'),
                "param_name" => "pattern",
                "dependency"  => array( 'element' => 'style', 'value' => 'style2' ),
                "value" => array(
                    esc_html__('None', 'quanto')     => 'none',
                    esc_html__('Pattern Bottom', 'quanto')     => 'card-pattern-bottom',
                    esc_html__('Pattern Top', 'quanto')     => 'card-pattern-top',
                    esc_html__('Pattern Left Bottom', 'quanto')     => 'card-pattern-left',
                    esc_html__('Pattern Left Top', 'quanto')     => 'card-pattern-left-top',
                    esc_html__('Pattern Right Bottom', 'quanto')     => 'card-pattern-right',
                    esc_html__('Pattern Right Top', 'quanto')     => 'card-pattern-right-top',
                    esc_html__('Pattern Full', 'quanto')     => 'card-pattern-full',
                ),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

// Call To Action (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Call To Action", 'quanto'),
        "base" => "cta",
        "class" => "",
        "category" => 'Quanto Element',
        "icon" => "icon-st",
        "params" => array(
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => esc_html__("Style", 'quanto'),
                "param_name" => "style",
                "value" => array(
                    esc_html__('Style 1', 'quanto') => 'style1',
                    esc_html__('Style 2', 'quanto') => 'style2',
                    esc_html__('Style 3', 'quanto') => 'style3',
                    esc_html__('Style 4', 'quanto') => 'style4',
                    esc_html__('Style 5', 'quanto') => 'style5',
                    esc_html__('Style 6', 'quanto') => 'style6',
                ),
            ),
            array(
                "type" => "iconpicker",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Icon', 'quanto'),
                "param_name" => "icon",
                "dependency"  => array( 'element' => 'style', 'value' => 'style1' ),
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Title', 'quanto'),
                "param_name" => "title",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Subtitle', 'quanto'),
                "dependency"  => array( 'element' => 'style', 'value' => 'style6' ),
                "param_name" => "stitle",
                "value" => "",
            ),
            array(
                "type" => "textarea_html",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Content", 'quanto'),
                "param_name" => "content",
                "value" => '',
            ),
            array(
                "type" => "vc_link",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Link", 'quanto'),
                "param_name" => "link",
                "value" => '',
            ),
            array(
                "type" => "vc_link",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Link 2", 'quanto'),
                "param_name" => "link2",
                "dependency"  => array( 'element' => 'style', 'value' => array('style2','style3') ),
                "value" => '',
            ),
            array(
                "type" => "attach_image",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Image", 'quanto'),
                "dependency"  => array( 'element' => 'style', 'value' => array('style5','style6') ),
                "param_name" => "photo",
                "value" => "",
            ),
            array(
                "type" => "checkbox",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Pattern Slide Bottom", 'quanto'),
                "dependency"  => array( 'element' => 'style', 'value' => 'style6' ),
                "param_name" => "pattern",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

// Call To Action 2 (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Call To Action 2", 'quanto'),
        "base" => "ctas2",
        "class" => "",
        "category" => 'Quanto Element',
        "icon" => "icon-st",
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Title', 'quanto'),
                "param_name" => "title",
                "value" => "",
            ),
            array(
                "type" => "textarea_html",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Content", 'quanto'),
                "param_name" => "content",
                "value" => '',
            ),
            array(
                "type" => "attach_image",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Image Button 1", 'quanto'),
                "param_name" => "photo",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Link For Image Button 1", 'quanto'),
                "param_name" => "link",
                "value" => "",
            ),
            array(
                "type" => "attach_image",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Image Button 2", 'quanto'),
                "param_name" => "photo2",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Link For Image Button 2", 'quanto'),
                "param_name" => "link2",
                "value" => "",
            ),
            array(
                "type" => "attach_image",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Image Right", 'quanto'),
                "param_name" => "photo3",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

// Insurance icon Box (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Insurance icon Box", 'quanto'),
        "base" => "insb",
        "class" => "",
        "category" => 'Quanto Element',
        "icon" => "icon-st",
        "params" => array(
            array(
                "type" => "iconpicker",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("icon", 'quanto'),
                "param_name" => "icon",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Title', 'quanto'),
                "param_name" => "title",
                "value" => "",
            ),
            array(
                "type" => "textarea_html",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Content", 'quanto'),
                "param_name" => "content",
                "value" => '',
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__('Pattern', 'quanto'),
                "param_name" => "pattern",
                "value" => array(
                    esc_html__('None', 'quanto')     => 'none',
                    esc_html__('Pattern Bottom', 'quanto')     => 'card-pattern-bottom',
                    esc_html__('Pattern Top', 'quanto')     => 'card-pattern-top',
                    esc_html__('Pattern Left Bottom', 'quanto')     => 'card-pattern-left',
                    esc_html__('Pattern Left Top', 'quanto')     => 'card-pattern-left-top',
                    esc_html__('Pattern Right Bottom', 'quanto')     => 'card-pattern-right',
                    esc_html__('Pattern Right Top', 'quanto')     => 'card-pattern-right-top',
                    esc_html__('Pattern Full', 'quanto')     => 'card-pattern-full',
                ),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

// insurance Slider (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Insurance Slider", 'quanto'),
        "base" => "inslide",
        "class" => "",
        "category" => 'Quanto Element',
        "params" => array(
            array(
                'type' => 'param_group',
                'heading' => esc_html__("Insurance Slider", 'quanto'),
                'value' => '',
                'param_name' => 'insurance',
                // Note params is mapped inside param-group:
                'params' => array(
                    array(
                        'type' => 'iconpicker',
                        'value' => '',
                        'heading' => esc_html__('Icon', 'quanto'),
                        'param_name' => 'icon',
                        "description" => esc_html__("Select icon",'quanto')
                    ),
                    array(
                        'type' => 'colorpicker',
                        'value' => '',
                        'heading' => esc_html__('Color Icon', 'quanto'),
                        'param_name' => 'color',
                    ),
                    array(
                        'type' => 'colorpicker',
                        'value' => '',
                        'heading' => esc_html__('Background Color Icon', 'quanto'),
                        'param_name' => 'bg_color',
                    ),
                    array(
                        'type' => 'colorpicker',
                        'value' => '',
                        'heading' => esc_html__('Background Color Top Section', 'quanto'),
                        'param_name' => 'bg_color2',
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        'value' => '',
                        'heading' => esc_html__('Title', 'quanto'),
                        'param_name' => 'title',
                    ),
                    array(
                        'type' => 'textarea',
                        "holder" => "div",
                        'value' => '',
                        'heading' => esc_html__('Subtitle', 'quanto'),
                        'param_name' => 'stitle',
                    ),
                    array(
                        'type' => 'vc_link',
                        'value' => '',
                        "edit_field_class" => "vc_col-sm-6",
                        'heading' => esc_html__('Button', 'quanto'),
                        'param_name' => 'link',
                    ),
                )
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => esc_html__('Column', 'quanto'),
                "param_name" => "show",
                "value" => array(
                    esc_html__('3 Columns', 'quanto')     => '3',
                    esc_html__('2 Columns', 'quanto')     => '2',
                    esc_html__('4 Columns', 'quanto')     => '4',
                    esc_html__('5 Columns', 'quanto')     => '5',
                    esc_html__('6 Columns', 'quanto')     => '6',
                ),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Auto play", 'quanto'),
                "param_name" => "auto",
                "value" => "auto",
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Arrow", 'quanto'),
                "param_name" => "arr",
                "value" => array(
                    esc_html__('True', 'quanto') => 'true',
                    esc_html__('False ', 'quanto') => 'false',
                ),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

// Calculator (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Calculator", 'quanto'),
        "base" => "calculatorf",
        "class" => "",
        "category" => 'Quanto Element',
        "icon" => "icon-st",
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Currency", 'quanto'),
                "param_name" => "currency",
                "value" => '',
                "description" => esc_html__("Default: $", 'quanto'),
                "group" => esc_html__("General", 'quanto'),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Amount Default", 'quanto'),
                "param_name" => "amount",
                "value" => '',
                "description" => esc_html__("Ex: 7,500, 8,500", 'quanto'),
                "group" => esc_html__("General", 'quanto'),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Rate Default", 'quanto'),
                "param_name" => "rate",
                "value" => '',
                "description" => esc_html__("Ex: 6%, 7%, 8%", 'quanto'),
                "group" => esc_html__("General", 'quanto'),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Term Default", 'quanto'),
                "param_name" => "term",
                "value" => '',
                "description" => esc_html__("Ex: 36m, 72m, 2y, 3y", 'quanto'),
                "group" => esc_html__("General", 'quanto'),
            ),
            array(
                "type" => "checkbox",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Disable', 'quanto'),
                "param_name" => "cal_dis",
                "value" => "",
                "group" => esc_html__("Calculator Default", 'quanto'),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Title', 'quanto'),
                "param_name" => "title",
                "value" => "",
                "group" => esc_html__("Calculator Default", 'quanto'),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Title Right", 'quanto'),
                "param_name" => "title_r",
                "value" => '',
                "group" => esc_html__("Calculator Default", 'quanto'),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Amount Label Text", 'quanto'),
                "param_name" => "amount_lb",
                "value" => '',
                "group" => esc_html__("Calculator Default", 'quanto'),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Rate Label Text", 'quanto'),
                "param_name" => "rate_lb",
                "value" => '',
                "group" => esc_html__("Calculator Default", 'quanto'),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Rate Compare Label Text", 'quanto'),
                "param_name" => "rate_compare_lb",
                "value" => '',
                "group" => esc_html__("Calculator Default", 'quanto'),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Term Label Text", 'quanto'),
                "param_name" => "term_bl",
                "value" => '',
                "group" => esc_html__("Calculator Default", 'quanto'),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Term Comment", 'quanto'),
                "param_name" => "term_alt",
                "value" => '',
                "group" => esc_html__("Calculator Default", 'quanto'),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Payment Amount Label on right column", 'quanto'),
                "param_name" => "payment_amount_tx",
                "value" => '',
                "group" => esc_html__("Calculator Default", 'quanto'),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Number of Payments Label on right column", 'quanto'),
                "param_name" => "num_payments_tx",
                "value" => '',
                "group" => esc_html__("Calculator Default", 'quanto'),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Total Payments Label on right column", 'quanto'),
                "param_name" => "total_payments_tx",
                "value" => '',
                "group" => esc_html__("Calculator Default", 'quanto'),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Total Interest Label on right column", 'quanto'),
                "param_name" => "total_interest_tx",
                "value" => '',
                "group" => esc_html__("Calculator Default", 'quanto'),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Error Label on right column", 'quanto'),
                "param_name" => "error_tx",
                "value" => '',
                "group" => esc_html__("Calculator Default", 'quanto'),
            ),
            array(
                "type" => "vc_link",
                "holder" => "div",
                "heading" => esc_html__("Button", 'quanto'),
                "param_name" => "link",
                "group" => esc_html__("Calculator Default", 'quanto'),
            ),
            array(
                "type" => "checkbox",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Disable', 'quanto'),
                "param_name" => "as_dis",
                "value" => "",
                "group" => esc_html__("Amortization Schedule Calculation", 'quanto'),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Title Amortization Schedule Calculation', 'quanto'),
                "param_name" => "title2",
                "value" => "",
                "group" => esc_html__("Amortization Schedule Calculation", 'quanto'),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Title 2", 'quanto'),
                "param_name" => "titletb",
                "value" => '',
                "group" => esc_html__("Amortization Schedule Calculation", 'quanto'),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Column Title 1", 'quanto'),
                "param_name" => "thead1",
                "value" => '',
                "group" => esc_html__("Amortization Schedule Calculation", 'quanto'),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Column Title 2", 'quanto'),
                "param_name" => "thead2",
                "value" => '',
                "group" => esc_html__("Amortization Schedule Calculation", 'quanto'),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Column Title 3", 'quanto'),
                "param_name" => "thead3",
                "value" => '',
                "group" => esc_html__("Amortization Schedule Calculation", 'quanto'),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Column Title 4", 'quanto'),
                "param_name" => "thead4",
                "value" => '',
                "group" => esc_html__("Amortization Schedule Calculation", 'quanto'),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Column Title 5", 'quanto'),
                "param_name" => "thead5",
                "value" => '',
                "group" => esc_html__("Amortization Schedule Calculation", 'quanto'),
            ),
        )));
}

// Socials icon (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Socials icon", 'quanto'),
        "base" => "socialsicon",
        "class" => "",
        "category" => 'Quanto Element',
        "params" => array(
            array(
                'type' => 'param_group',
                'heading' => esc_html__("Socials", 'quanto'),
                'value' => '',
                'param_name' => 'slide',
                // Note params is mapped inside param-group:
                'params' => array(
                    array(
                        'type' => 'iconpicker',
                        "holder" => "div",
                        'value' => '',
                        'heading' => esc_html__('Icon', 'quanto'),
                        'param_name' => 'icon',
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        'value' => '',
                        'heading' => esc_html__('Link Social', 'quanto'),
                        'param_name' => 'link',
                    ),
                    array(
                        "type" => "dropdown",
                        "holder" => "div",
                        "edit_field_class" => "vc_col-sm-6",
                        "heading" => esc_html__("Size", 'quanto'),
                        "param_name" => "size",
                        "value" => array(
                            esc_html__('Default', 'quanto') => 'social-size-default',
                            esc_html__('Small', 'quanto') => 'social-icon-small',
                        ),
                    ),
                    array(
                        "type" => "dropdown",
                        "holder" => "div",
                        "edit_field_class" => "vc_col-sm-6",
                        "heading" => esc_html__("Type", 'quanto'),
                        "param_name" => "type",
                        "value" => array(
                            esc_html__('Default', 'quanto') => 'type-default',
                            esc_html__('rounded', 'quanto') => 'social-rounded',
                        ),
                    ),
                    array(
                        "type" => "dropdown",
                        "holder" => "div",
                        "edit_field_class" => "vc_col-sm-6",
                        "heading" => esc_html__("Style", 'quanto'),
                        "param_name" => "style",
                        "value" => array(
                            esc_html__('Default', 'quanto') => 'social-default',
                            esc_html__('Facebook', 'quanto') => 'social-facebook',
                            esc_html__('Twitter', 'quanto') => 'social-twitter',
                            esc_html__('Google', 'quanto')      => 'social-google',
                            esc_html__('Linkedin', 'quanto')      => 'social-linkedin',
                            esc_html__('Youtube', 'quanto')   => 'social-youtube',
                            esc_html__('Instagram', 'quanto')   => 'social-instagram',
                            esc_html__('Pinterest', 'quanto')   => 'social-pinterest',
                            esc_html__('Snapchat Ghost', 'quanto')   => 'social-snapchat-ghost',
                            esc_html__('Skype', 'quanto')   => 'social-skype',
                            esc_html__('Dribbble', 'quanto')   => 'social-dribbble',
                            esc_html__('Vimeo', 'quanto')      => 'social-vimeo',
                            esc_html__('Tumblr', 'quanto')      => 'social-tumblr',
                            esc_html__('Vine', 'quanto')      => 'social-vine',
                            esc_html__('Foursquare', 'quanto')      => 'social-foursquare',
                            esc_html__('Stumbleupon', 'quanto')      => 'social-stumbleupon',
                            esc_html__('Flickr', 'quanto')      => 'social-flickr',
                            esc_html__('Rss', 'quanto')      => 'social-rss',
                        ),
                    ),
                    array(
                        "type" => "dropdown",
                        "holder" => "div",
                        "edit_field_class" => "vc_col-sm-6",
                        "heading" => esc_html__("Style Ouline", 'quanto'),
                        "param_name" => "ouline",
                        "value" => array(
                            esc_html__('None', 'quanto') => 'none',
                            esc_html__('Default', 'quanto') => 'social-icon-outline',
                            esc_html__('Facebook', 'quanto') => 'social-outline-facebook',
                            esc_html__('Twitter', 'quanto') => 'social-outline-twitter',
                            esc_html__('Google', 'quanto')      => 'social-outline-google',
                            esc_html__('Linkedin', 'quanto')      => 'social-outline-linkedin',
                            esc_html__('Youtube', 'quanto')   => 'social-outline-youtube',
                            esc_html__('Instagram', 'quanto')   => 'social-outline-instagram',
                            esc_html__('Pinterest', 'quanto')   => 'social-outline-pinterest',
                            esc_html__('Snapchat Ghost', 'quanto')   => 'social-outline-snapchat-ghost',
                            esc_html__('Skype', 'quanto')   => 'social-outline-skype',
                            esc_html__('Dribbble', 'quanto')   => 'social-outline-dribbble',
                            esc_html__('Vimeo', 'quanto')      => 'social-outline-vimeo',
                            esc_html__('Tumblr', 'quanto')      => 'social-outline-tumblr',
                            esc_html__('Vine', 'quanto')      => 'social-outline-vine',
                            esc_html__('Foursquare', 'quanto')      => 'social-outline-foursquare',
                            esc_html__('Stumbleupon', 'quanto')      => 'social-outline-stumbleupon',
                            esc_html__('Flickr', 'quanto')      => 'social-outline-flickr',
                            esc_html__('Rss', 'quanto')      => 'social-outline-rss',
                        ),
                    ),
                    array(
                        'type' => 'textfield',
                        'value' => '',
                        'heading' => esc_html__('Class Icon', 'quanto'),
                        'param_name' => 'class',
                    ),
                )
            ),
        )));
}

// List Box (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT List Box", 'quanto'),
        "base" => "listb",
        "class" => "",
        "category" => 'Quanto Element',
        "params" => array(
            array(
                'type' => 'param_group',
                'heading' => esc_html__("List", 'quanto'),
                'value' => '',
                'param_name' => 'slide',
                // Note params is mapped inside param-group:
                'params' => array(
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        'value' => '',
                        'heading' => esc_html__('Title', 'quanto'),
                        'param_name' => 'title',
                    ),
                    array(
                        'type' => 'textarea',
                        "holder" => "div",
                        'value' => '',
                        'heading' => esc_html__('Subtitle', 'quanto'),
                        'param_name' => 'stitle',
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        'value' => '',
                        'heading' => esc_html__('Link', 'quanto'),
                        'param_name' => 'link',
                    ),
                )
            ),
            array(
                'type' => 'textfield',
                'value' => '',
                'heading' => esc_html__('Extra Class', 'quanto'),
                'param_name' => 'class',
                "description" => esc_html__("You can add class. If you want to custom css code.", 'quanto')
            ),
        )));
}

// Process Box (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Process Box", 'quanto'),
        "base" => "howitwork",
        "class" => "",
        "category" => 'Quanto Element',
        "icon" => "icon-st",
        "params" => array(
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => esc_html__("Style", 'quanto'),
                "param_name" => "style",
                "value" => array(
                    esc_html__('Style 1', 'quanto') => 'style1',
                    esc_html__('Style 2 (align left + number text color primary)', 'quanto') => 'style2',
                    esc_html__('Style 3 (icon)', 'quanto') => 'style3',
                    esc_html__('Style 4 ', 'quanto') => 'style4',
                    esc_html__('Style 5 ', 'quanto') => 'style5',
                ),
            ),
            array(
                "type" => "iconpicker",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Icon', 'quanto'),
                "param_name" => "icon",
                "dependency"  => array( 'element' => 'style', 'value' => 'style3' ),
                "value" => "",
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Color icon/number', 'quanto'),
                "param_name" => "color",
                "dependency"  => array( 'element' => 'style', 'value' => array('style1','style3') ),
                "value" => "",
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Background Color icon/number', 'quanto'),
                "param_name" => "bg",
                "dependency"  => array( 'element' => 'style', 'value' => array('style1','style3') ),
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Number', 'quanto'),
                "param_name" => "number",
                "dependency"  => array( 'element' => 'style', 'value' => array('style1','style2','style4','style5') ),
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Title', 'quanto'),
                "param_name" => "title",
                "value" => "",
            ),
            array(
                "type" => "textarea_html",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Content", 'quanto'),
                "param_name" => "content",
                "value" => '',
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

// Gallery List (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Gallery List Simple", 'quanto'),
        "base" => "listg",
        "class" => "",
        "category" => 'Quanto Element',
        "icon" => "icon-st",
        "params" => array(
            array(
                "type" => "attach_images",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Images', 'quanto'),
                "param_name" => "gallery",
                "value" => "",
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__('Slide To Show', 'quanto'),
                "param_name" => "show",
                "value" => array(
                    esc_html__('4 Images', 'quanto')     => '4',
                    esc_html__('3 Images', 'quanto')     => '3',
                    esc_html__('2 Images', 'quanto')     => '2',
                ),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

// Gallery (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Gallery", 'quanto'),
        "base" => "galleryf",
        "class" => "",
        "icon" => "icon-st",
        "category" => 'Quanto Element',
        "params" => array(
            array(
                "type" => "checkbox",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-6",
                "class" => "",
                "heading" => esc_html__("Show Filter?", 'quanto'),
                "param_name" => "filter",
            ),
            array(
                "type" => "checkbox",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-6",
                "class" => "",
                "heading" => esc_html__("Disable Popup Image", 'quanto'),
                "param_name" => "dis_popup",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Show All Text", 'quanto'),
                "param_name" => "all",
                "dependency"  => array( 'element' => 'filter', 'value' => 'true' ),
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-6",
                "heading" => esc_html__('Column', 'quanto'),
                "param_name" => "col",
                "value" => array(
                    esc_html__('4 Columns', 'quanto')     => '4',
                    esc_html__('3 Columns', 'quanto')     => '3',
                    esc_html__('2 Columns', 'quanto')     => '2',
                ),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-6",
                "class" => "",
                "heading" => esc_html__("Show Number Projects", 'quanto'),
                "param_name" => "num",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

// Portfolio Filter (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Portfolio Filter", 'quanto'),
        "base" => "portfoliof",
        "class" => "",
        "icon" => "icon-st",
        "category" => 'Quanto Element',
        "params" => array(
            array(
                "type" => "checkbox",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Show Filter?", 'quanto'),
                "param_name" => "filter",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Show All Text", 'quanto'),
                "param_name" => "all",
                "dependency"  => array( 'element' => 'filter', 'value' => 'true' ),
            ),
            array(
                "type" => "checkbox",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Disable Content", 'quanto'),
                "edit_field_class" => "vc_col-sm-6",
                "param_name" => "dis_cont",
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-6",
                "heading" => esc_html__('Column', 'quanto'),
                "param_name" => "col",
                "value" => array(
                    esc_html__('4 Columns', 'quanto')     => '4',
                    esc_html__('3 Columns', 'quanto')     => '3',
                    esc_html__('2 Columns', 'quanto')     => '2',
                ),
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-6",
                "heading" => esc_html__('Link Image', 'quanto'),
                "param_name" => "link_st",
                "value" => array(
                    esc_html__('Single', 'quanto')     => 'single',
                    esc_html__('Popup Image', 'quanto')     => 'popup',
                ),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-6",
                "class" => "",
                "heading" => esc_html__("Show Number Projects", 'quanto'),
                "param_name" => "num",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

//Help Center (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Help Center List", 'quanto'),
        "base" => "helpcenter",
        'admin_enqueue_js'  => get_template_directory_uri() . '/inc/backend/js/select2.min.js',
        'admin_enqueue_css' => get_template_directory_uri() . '/inc/backend/css/select2.css',
        "class" => "",
        "icon" => "icon-st",
        "category" => 'Quanto Element',
        "params" => array(
            array(
                "type" => "dropdown",
                "heading" => esc_html__('Column', 'quanto'),
                "param_name" => "show",
                "value" => array(
                    esc_html__('4 Columns', 'quanto')     => '4',
                    esc_html__('3 Columns', 'quanto')     => '3',
                    esc_html__('2 Columns', 'quanto')     => '2',
                ),
            ),
            array(
                "type"      => "select_projects",
                "holder"    => "div",
                "class"     => "",
                "heading"   => esc_html__("Help List", 'quanto'),
                "param_name"=> "idpost",
                "value"     => "",
                "description" => esc_html__("Enter help name.", 'quanto')
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Show Number", 'quanto'),
                "param_name" => "num",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

//Help Center Category (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Help Center Category", 'quanto'),
        "base" => "helpcate",
        'admin_enqueue_js'  => get_template_directory_uri() . '/inc/backend/js/select2.min.js',
        'admin_enqueue_css' => get_template_directory_uri() . '/inc/backend/css/select2.css',
        "class" => "",
        "icon" => "icon-st",
        "category" => 'Quanto Element',
        "params" => array(
            array(
                "type"      => "select_cate",
                "holder"    => "div",
                "class"     => "",
                "heading"   => esc_html__("Categories List", 'quanto'),
                "param_name"=> "idcate",
                "value"     => "",
                "description" => esc_html__("Enter categories name.", 'quanto')
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Show Number", 'quanto'),
                "param_name" => "num",
            ),
            array(
                "type" => "vc_link",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Link", 'quanto'),
                "param_name" => "link",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

//Help Center Relate (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Help Center Relate", 'quanto'),
        "base" => "helprelate",
        "class" => "",
        "icon" => "icon-st",
        "category" => 'Quanto Element',
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Show Number", 'quanto'),
                "param_name" => "num",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Title", 'quanto'),
                "param_name" => "title",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

// Accordions (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Accordions", 'quanto'),
        "base" => "accordions",
        "class" => "",
        "category" => 'Quanto Element',
        "params" => array(
            array(
                'type' => 'dropdown',
                'value' => '',
                'heading' => esc_html__('Style', 'quanto'),
                'param_name' => 'style',
                "value" => array(
                    esc_html__('Style 1', 'quanto')   => 'style1',
                    esc_html__('Style 2', 'quanto')   => 'style2',
                    esc_html__('Style 3', 'quanto')   => 'style3',
                ),
            ),
            array(
                'type' => 'param_group',
                'heading' => esc_html__("Accordions", 'quanto'),
                'value' => '',
                'param_name' => 'accordions',
                // Note params is mapped inside param-group:
                'params' => array(
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        'value' => '',
                        'heading' => esc_html__('Title', 'quanto'),
                        'param_name' => 'title',
                    ),
                    array(
                        'type' => 'textarea',
                        'value' => '',
                        'heading' => esc_html__('Description', 'quanto'),
                        'param_name' => 'desc',
                    ),
                    array(
                        'type' => 'checkbox',
                        "holder" => "div",
                        'value' => '',
                        'heading' => esc_html__('Active Content', 'quanto'),
                        'param_name' => 'show',
                    ),
                )
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

// Tab (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Tab", 'quanto'),
        "base" => "tab_ot",
        "class" => "",
        "category" => 'Quanto Element',
        "params" => array(
            array(
                'type' => 'dropdown',
                'value' => '',
                'heading' => esc_html__('Style', 'quanto'),
                'param_name' => 'style',
                "value" => array(
                    esc_html__('Basic Tabs', 'quanto')   => 'style1',
                    esc_html__('Vertical Tabs', 'quanto')   => 'style2',
                    esc_html__('Simple Card Tabs', 'quanto')   => 'style3',
                    esc_html__('Pills Tabs', 'quanto')   => 'style4',
                    esc_html__('Vertical Pills Tabs', 'quanto')   => 'style5',
                    esc_html__('Justified Tabs', 'quanto')   => 'style6',
                    esc_html__('Justified Regular Tab', 'quanto')   => 'style7',
                ),
            ),
            array(
                'type' => 'param_group',
                'heading' => esc_html__("Tab", 'quanto'),
                'value' => '',
                'param_name' => 'accordions',
                // Note params is mapped inside param-group:
                "dependency"  => array( 'element' => 'style', 'value' => array('style6','style5','style4','style3','style2','style1')),
                'params' => array(
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        'value' => '',
                        'heading' => esc_html__('Title', 'quanto'),
                        'param_name' => 'title',
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        'value' => '',
                        'heading' => esc_html__('Title on Content', 'quanto'),
                        'param_name' => 'titct',
                    ),
                    array(
                        'type' => 'textarea',
                        'value' => '',
                        'heading' => esc_html__('Description', 'quanto'),
                        'param_name' => 'desc',
                    ),
                    array(
                        'type' => 'vc_link',
                        'value' => '',
                        'heading' => esc_html__('Link', 'quanto'),
                        'param_name' => 'link',
                    ),
                    array(
                        'type' => 'checkbox',
                        "holder" => "div",
                        'value' => '',
                        'heading' => esc_html__('Active Content', 'quanto'),
                        'param_name' => 'show',
                    ),
                )
            ),
            array(
                'type' => 'param_group',
                'heading' => esc_html__("Tab", 'quanto'),
                'value' => '',
                'param_name' => 'accordions2',
                "dependency"  => array( 'element' => 'style', 'value' => 'style7'),
                // Note params is mapped inside param-group:
                'params' => array(
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        'value' => '',
                        'heading' => esc_html__('Title', 'quanto'),
                        'param_name' => 'title',
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        'value' => '',
                        'heading' => esc_html__('Title on Content', 'quanto'),
                        'param_name' => 'titct',
                    ),
                    array(
                        'type' => 'textarea',
                        'value' => '',
                        'heading' => esc_html__('Description', 'quanto'),
                        'param_name' => 'desc',
                    ),
                    array(
                        'type' => 'attach_image',
                        'value' => '',
                        'heading' => esc_html__('Image', 'quanto'),
                        'param_name' => 'image',
                    ),
                    array(
                        'type' => 'attach_image',
                        'value' => '',
                        'heading' => esc_html__('Image 2', 'quanto'),
                        'param_name' => 'image2',
                    ),
                    array(
                        'type' => 'vc_link',
                        'value' => '',
                        'heading' => esc_html__('Link', 'quanto'),
                        'param_name' => 'link',
                    ),
                    array(
                        'type' => 'checkbox',
                        "holder" => "div",
                        'value' => '',
                        'heading' => esc_html__('Active Content', 'quanto'),
                        'param_name' => 'show',
                    ),
                )
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

// Testimonial List (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Testimonials List", 'quanto'),
        "base" => "testimonialslist",
        "class" => "",
        "category" => 'Quanto Element',
        "params" => array(
            array(
                'type' => 'dropdown',
                'value' => '',
                'heading' => esc_html__('Style', 'quanto'),
                'param_name' => 'style',
                "value" => array(
                    esc_html__('Style 1', 'quanto')   => 'style1',
                    esc_html__('Style 2', 'quanto')   => 'style2',
                    esc_html__('Style 3', 'quanto')   => 'style3',
                    esc_html__('Style 4', 'quanto')   => 'style4',
                    esc_html__('Style 5', 'quanto')   => 'style5',
                ),
            ),
            array(
                'type' => 'param_group',
                'heading' => esc_html__("Testimonials", 'quanto'),
                'value' => '',
                'param_name' => 'testi',
                "dependency"  => array( 'element' => 'style', 'value' => 'style1'),
                // Note params is mapped inside param-group:
                'params' => array(
                    array(
                        'type' => 'attach_image',
                        'value' => '',
                        'heading' => 'Client Photo',
                        'param_name' => 'photo',
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "edit_field_class" => "vc_col-sm-6",
                        'value' => '',
                        'heading' => esc_html__('Client Name', 'quanto'),
                        'param_name' => 'name',
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "edit_field_class" => "vc_col-sm-6",
                        'value' => '',
                        'heading' => esc_html__('Client Job', 'quanto'),
                        'param_name' => 'job',
                    ),
                    array(
                        'type' => 'textarea',
                        'value' => '',
                        'heading' => esc_html__('Client Says', 'quanto'),
                        'param_name' => 'des',
                    ),
                )
            ),
            array(
                'type' => 'param_group',
                'heading' => esc_html__("Testimonials", 'quanto'),
                'value' => '',
                'param_name' => 'testi2',
                "dependency"  => array( 'element' => 'style', 'value' => array('style2','style3','style4','style5')),
                // Note params is mapped inside param-group:
                'params' => array(
                    array(
                        'type' => 'attach_image',
                        'value' => '',
                        'heading' => 'Client Photo',
                        'param_name' => 'photo',
                    ),
                    array(
                        'type' => 'textarea',
                        'value' => '',
                        'heading' => esc_html__('Client Says', 'quanto'),
                        'param_name' => 'des',
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "edit_field_class" => "vc_col-sm-6",
                        'value' => '',
                        'heading' => esc_html__('Client Name', 'quanto'),
                        'param_name' => 'name',
                    ),
                    array(
                        'type' => 'checkbox',
                        "holder" => "div",
                        "edit_field_class" => "vc_col-sm-6",
                        'value' => '',
                        'heading' => esc_html__('Dissable Rating', 'quanto'),
                        'param_name' => 'dis_rate',
                    ),
                    array(
                        'type' => 'dropdown',
                        'value' => '',
                        'heading' => esc_html__('Rate?', 'quanto'),
                        'param_name' => 'rate',
                        "value" => array(
                            esc_html__('5 Star', 'quanto')   => '5star',
                            esc_html__('4.5 Star', 'quanto')   => '4s-half',
                            esc_html__('4 Star', 'quanto')   => '4star',
                            esc_html__('3.5 Star', 'quanto')   => '3s-half',
                            esc_html__('3 Star', 'quanto')   => '3star',
                            esc_html__('2.5 Star', 'quanto')   => '2s-half',
                            esc_html__('2 Star', 'quanto')   => '2star',
                            esc_html__('1.5 Star', 'quanto')   => '1s-half',
                            esc_html__('1 Star', 'quanto')   => '1star',
                            esc_html__('half Star', 'quanto')   => 'half',
                        ),
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        'value' => '',
                        'heading' => esc_html__('Text ', 'quanto'),
                        'param_name' => 'ratext',
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => esc_html__('Pattern', 'quanto'),
                        "param_name" => "pattern",
                        "dependency"  => array( 'element' => 'style', 'value' => 'style2' ),
                        "value" => array(
                            esc_html__('None', 'quanto')     => 'none',
                            esc_html__('Pattern Bottom', 'quanto')     => 'card-pattern-bottom',
                            esc_html__('Pattern Top', 'quanto')     => 'card-pattern-top',
                            esc_html__('Pattern Left Bottom', 'quanto')     => 'card-pattern-left',
                            esc_html__('Pattern Left Top', 'quanto')     => 'card-pattern-left-top',
                            esc_html__('Pattern Right Bottom', 'quanto')     => 'card-pattern-right',
                            esc_html__('Pattern Right Top', 'quanto')     => 'card-pattern-right-top',
                            esc_html__('Pattern Full', 'quanto')     => 'card-pattern-full',
                        ),
                    ),
                )
            ),
            array(
                'type' => 'dropdown',
                'value' => '',
                'heading' => esc_html__('Column?', 'quanto'),
                'param_name' => 'col',
                "dependency"  => array( 'element' => 'style', 'value' => array('style2','style3','style4','style5')),
                "value" => array(
                    esc_html__('3 Column', 'quanto')   => '3',
                    esc_html__('2 Column', 'quanto')   => '2',
                    esc_html__('4 Column', 'quanto')   => '4',
                ),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

// Testimonial Slider (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Testimonials Slider", 'quanto'),
        "base" => "testimonials",
        "class" => "",
        "category" => 'Quanto Element',
        "params" => array(
            array(
                'type' => 'dropdown',
                'value' => '',
                'heading' => esc_html__('Style', 'quanto'),
                'param_name' => 'style',
                "value" => array(
                    esc_html__('Style 1', 'quanto')   => 'style1',
                    esc_html__('Style 2', 'quanto')   => 'style2',
                    esc_html__('Style 3', 'quanto')   => 'style3',
                    esc_html__('Style 4', 'quanto')   => 'style4',
                    esc_html__('Style 5', 'quanto')   => 'style5',
                ),
            ),
            array(
                'type' => 'param_group',
                'heading' => esc_html__("Testimonials", 'quanto'),
                'value' => '',
                'param_name' => 'testi',
                "dependency"  => array( 'element' => 'style', 'value' => array('style1','style2','style4','style5')),
                // Note params is mapped inside param-group:
                'params' => array(
                    array(
                        'type' => 'attach_image',
                        'value' => '',
                        'heading' => 'Client Photo',
                        'param_name' => 'photo',
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "edit_field_class" => "vc_col-sm-6",
                        'value' => '',
                        'heading' => esc_html__('Client Name', 'quanto'),
                        'param_name' => 'name',
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "edit_field_class" => "vc_col-sm-6",
                        'value' => '',
                        'heading' => esc_html__('Client Job', 'quanto'),
                        'param_name' => 'job',
                    ),
                    array(
                        'type' => 'textarea',
                        'value' => '',
                        'heading' => esc_html__('Client Says', 'quanto'),
                        'param_name' => 'des',
                    ),
                )
            ),
            array(
                'type' => 'param_group',
                'heading' => esc_html__("Testimonials", 'quanto'),
                'value' => '',
                'param_name' => 'testi2',
                "dependency"  => array( 'element' => 'style', 'value' => 'style3'),
                // Note params is mapped inside param-group:
                'params' => array(
                    array(
                        'type' => 'attach_image',
                        'value' => '',
                        'heading' => 'Client Photo',
                        'param_name' => 'photo',
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "edit_field_class" => "vc_col-sm-6",
                        'value' => '',
                        'heading' => esc_html__('Client Name', 'quanto'),
                        'param_name' => 'name',
                    ),
                    array(
                        'type' => 'dropdown',
                        'value' => '',
                        'heading' => esc_html__('Rate?', 'quanto'),
                        'param_name' => 'rate',
                        "edit_field_class" => "vc_col-sm-6",
                        "value" => array(
                            esc_html__('5 Star', 'quanto')   => '5star',
                            esc_html__('4.5 Star', 'quanto')   => '4s-half',
                            esc_html__('4 Star', 'quanto')   => '4star',
                            esc_html__('3.5 Star', 'quanto')   => '3s-half',
                            esc_html__('3 Star', 'quanto')   => '3star',
                            esc_html__('2.5 Star', 'quanto')   => '2s-half',
                            esc_html__('2 Star', 'quanto')   => '2star',
                            esc_html__('1.5 Star', 'quanto')   => '1s-half',
                            esc_html__('1 Star', 'quanto')   => '1star',
                            esc_html__('half Star', 'quanto')   => 'half',
                        ),
                    ),
                    array(
                        'type' => 'textarea',
                        'value' => '',
                        'heading' => esc_html__('Client Says', 'quanto'),
                        'param_name' => 'des',
                    ),
                )
            ),
            array(
                'type' => 'dropdown',
                'value' => '',
                'heading' => esc_html__('Slide To Show', 'quanto'),
                'param_name' => 'show',
                "dependency"  => array( 'element' => 'style', 'value' => array('style1','style3','style5')),
                "value" => array(
                    esc_html__('3 Items', 'quanto')   => '3',
                    esc_html__('2 Items', 'quanto')   => '2',
                    esc_html__('1 Item', 'quanto')   => '1',
                ),
            ),
            array(
                'type' => 'dropdown',
                'value' => '',
                'heading' => esc_html__('Slide To Show', 'quanto'),
                'param_name' => 'show2',
                "dependency"  => array( 'element' => 'style', 'value' => 'style4'),
                "value" => array(
                    esc_html__('5 Items', 'quanto')   => '5',
                    esc_html__('4 Items', 'quanto')   => '4',
                    esc_html__('3 Items', 'quanto')   => '3',
                ),
            ),
            array(
                'type' => 'checkbox',
                'value' => '',
                "holder"    => "div",
                "edit_field_class" => "vc_col-sm-6",
                'heading' => esc_html__('Autoplay?', 'quanto'),
                "dependency"  => array( 'element' => 'style', 'value' => array('style1','style3','style4','style5')),
                'param_name' => 'auto',
            ),
            array(
                'type' => 'checkbox',
                'value' => '',
                'heading' => esc_html__('Arrows Slide?', 'quanto'),
                "dependency"  => array( 'element' => 'style', 'value' => array('style1','style3','style4','style5')),
                "edit_field_class" => "vc_col-sm-6",
                'param_name' => 'nav',
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__('Pattern', 'quanto'),
                "param_name" => "parttern",
                "dependency"  => array( 'element' => 'style', 'value' => 'style1'),
                "value" => array(
                    esc_html__('None', 'quanto')     => 'none',
                    esc_html__('Pattern Bottom', 'quanto')     => 'card-pattern-bottom',
                    esc_html__('Pattern Top', 'quanto')     => 'card-pattern-top',
                    esc_html__('Pattern Left Bottom', 'quanto')     => 'card-pattern-left',
                    esc_html__('Pattern Left Top', 'quanto')     => 'card-pattern-left-top',
                    esc_html__('Pattern Right Bottom', 'quanto')     => 'card-pattern-right',
                    esc_html__('Pattern Right Top', 'quanto')     => 'card-pattern-right-top',
                    esc_html__('Pattern Full', 'quanto')     => 'card-pattern-full',
                ),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

// Mortgage Rates Block (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Mortgage Rates Block", 'quanto'),
        "base" => "mortgage_rate",
        "class" => "",
        "category" => 'Quanto Element',
        "params" => array(
            array(
                "type" => "dropdown",
                "heading" => esc_html__('Style', 'quanto'),
                "param_name" => "style",
                "value" => array(
                    esc_html__('Style 1', 'quanto')     => 'style1',
                    esc_html__('Style 2', 'quanto')     => 'style2',
                ),
            ),
            array(
                'type' => 'param_group',
                'heading' => esc_html__("Mortgage Rate", 'quanto'),
                'value' => '',
                'param_name' => 'rate',
                // Note params is mapped inside param-group:
                "dependency"  => array( 'element' => 'style', 'value' => 'style1'),
                'params' => array(
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        'value' => '',
                        'heading' => esc_html__('Title', 'quanto'),
                        'param_name' => 'title',
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        'value' => '',
                        'heading' => esc_html__('Rate', 'quanto'),
                        'param_name' => 'rate',
                    ),
                )
            ),
            array(
                'type' => 'param_group',
                'heading' => esc_html__("Mortgage Rate", 'quanto'),
                'value' => '',
                "dependency"  => array( 'element' => 'style', 'value' => 'style2'),
                'param_name' => 'rate2',
                // Note params is mapped inside param-group:
                'params' => array(
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        'value' => '',
                        'heading' => esc_html__('Title', 'quanto'),
                        'param_name' => 'title',
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        'value' => '',
                        'heading' => esc_html__('Rate', 'quanto'),
                        'param_name' => 'rate',
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        'value' => '',
                        'heading' => esc_html__('APR', 'quanto'),
                        'param_name' => 'apr',
                    ),
                    array(
                        'type' => 'textarea',
                        "holder" => "div",
                        'value' => '',
                        'heading' => esc_html__('Description', 'quanto'),
                        'param_name' => 'desc',
                    ),
                )
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

// Team List (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Team List (If you not use team single page )", 'quanto'),
        "base" => "teamlist",
        "class" => "",
        "category" => 'Quanto Element',
        "params" => array(
            array(
                'type' => 'param_group',
                'heading' => esc_html__("Member Team", 'quanto'),
                'value' => '',
                'param_name' => 'team',
                // Note params is mapped inside param-group:
                'params' => array(
                    array(
                        'type' => 'attach_image',
                        'value' => '',
                        'heading' => 'Member Photo',
                        'param_name' => 'photo',
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "edit_field_class" => "vc_col-sm-6",
                        'value' => '',
                        'heading' => esc_html__('Member Name', 'quanto'),
                        'param_name' => 'name',
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "edit_field_class" => "vc_col-sm-6",
                        'value' => '',
                        'heading' => esc_html__('Member Position', 'quanto'),
                        'param_name' => 'job',
                    ),
                )
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__('Columns', 'quanto'),
                "param_name" => "col",
                "value" => array(
                    esc_html__('4 Columns', 'quanto')     => '4',
                    esc_html__('3 Columns', 'quanto')     => '3',
                    esc_html__('2 Columns', 'quanto')     => '2',
                ),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

//Team (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Team", 'quanto'),
        "base" => "team",
        "class" => "",
        "icon" => "icon-st",
        "category" => 'Quanto Element',
        "params" => array(
            array(
                "type" => "dropdown",
                "heading" => esc_html__('Style', 'quanto'),
                "param_name" => "style",
                "value" => array(
                    esc_html__('Style 1', 'quanto')     => 'style1',
                    esc_html__('Style 2', 'quanto')     => 'style2',
                    esc_html__('Style 3', 'quanto')     => 'style3',
                    esc_html__('Remotify', 'quanto')     => 'remotify',
                ),
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__('Columns', 'quanto'),
                "param_name" => "col",
                "edit_field_class" => "vc_col-sm-6",
                "value" => array(
                    esc_html__('3 Columns', 'quanto')     => '3',
                    esc_html__('4 Columns', 'quanto')     => '4',
                    esc_html__('2 Columns', 'quanto')     => '2',
                ),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-6",
                "class" => "",
                "heading" => esc_html__("Number Posts", 'quanto'),
                "param_name" => "number",
                "value" => "6",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Button Text", 'quanto'),
                "param_name" => "btn",
                "dependency"  => array( 'element' => 'style', 'value' => 'style3'),
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

//Mortgage (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Mortgage", 'quanto'),
        "base" => "ot_mortgage",
        "class" => "",
        "icon" => "icon-st",
        "category" => 'Quanto Element',
        "params" => array(
            array(
                "type" => "dropdown",
                "heading" => esc_html__('Style', 'quanto'),
                "param_name" => "style",
                "edit_field_class" => "vc_col-sm-6",
                "value" => array(
                    esc_html__('Style 1', 'quanto')     => 'style1',
                    esc_html__('Style 2', 'quanto')     => 'style2',
                ),
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__('Mortgage Type', 'quanto'),
                "param_name" => "ot_type",
                "edit_field_class" => "vc_col-sm-6",
                "value" => array(
                    esc_html__('Client', 'quanto')     => 'client',
                    esc_html__('Freelancer', 'quanto')     => 'freelancer',
                ),
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__('Columns', 'quanto'),
                "param_name" => "col",
                "edit_field_class" => "vc_col-sm-6",
                "value" => array(
                    esc_html__('3 Columns', 'quanto')     => '3',
                    esc_html__('4 Columns', 'quanto')     => '4',
                    esc_html__('2 Columns', 'quanto')     => '2',
                ),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-6",
                "class" => "",
                "heading" => esc_html__("Number Posts", 'quanto'),
                "param_name" => "num",
                "value" => "6",
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__('Pattern', 'quanto'),
                "param_name" => "pattern",
                "edit_field_class" => "vc_col-sm-6",
                "value" => array(
                    esc_html__('None', 'quanto')     => 'none',
                    esc_html__('Pattern Bottom', 'quanto')     => 'card-pattern-bottom',
                    esc_html__('Pattern Top', 'quanto')     => 'card-pattern-top',
                    esc_html__('Pattern Left Bottom', 'quanto')     => 'card-pattern-left',
                    esc_html__('Pattern Left Top', 'quanto')     => 'card-pattern-left-top',
                    esc_html__('Pattern Right Bottom', 'quanto')     => 'card-pattern-right',
                    esc_html__('Pattern Right Top', 'quanto')     => 'card-pattern-right-top',
                    esc_html__('Pattern Full', 'quanto')     => 'card-pattern-full',
                ),
            ),
            array(
                "type" => "checkbox",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Button Show On/Off?", 'quanto'),
                "param_name" => "btnshow",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Button Text", 'quanto'),
                "dependency"  => array( 'element' => 'btnshow', 'value' => 'true'),
                "param_name" => "btntext",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

//Lenders (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Lenders", 'quanto'),
        "base" => "lenders",
        "class" => "",
        "icon" => "icon-st",
        "category" => 'Quanto Element',
        "params" => array(
            array(
                "type" => "dropdown",
                "heading" => esc_html__('Style', 'quanto'),
                "param_name" => "style",
                "edit_field_class" => "vc_col-sm-6",
                "value" => array(
                    esc_html__('Style 1', 'quanto')     => 'style1',
                    esc_html__('Style 2', 'quanto')     => 'style2',
                ),
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__('Columns', 'quanto'),
                "param_name" => "col",
                "dependency"  => array( 'element' => 'style', 'value' => 'style1'),
                "edit_field_class" => "vc_col-sm-6",
                "value" => array(
                    esc_html__('3 Columns', 'quanto')     => '3',
                    esc_html__('4 Columns', 'quanto')     => '4',
                    esc_html__('2 Columns', 'quanto')     => '2',
                ),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-6",
                "class" => "",
                "heading" => esc_html__("Number Posts", 'quanto'),
                "param_name" => "number",
                "value" => "9",
            ),
            array(
                "type" => "checkbox",
                "holder" => "div",
                "class" => "",
                "edit_field_class" => "vc_col-sm-6",
                "heading" => esc_html__("Button Show On/Off?", 'quanto'),
                "param_name" => "btnshow",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Button Text", 'quanto'),
                "dependency"  => array( 'element' => 'btnshow', 'value' => 'true'),
                "param_name" => "btntext",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

//Lenders Compare (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Lenders Compare", 'quanto'),
        "base" => "lenders_ss",
        "class" => "",
        "icon" => "icon-st",
        "category" => 'Quanto Element',
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Number Posts", 'quanto'),
                "param_name" => "number",
                "value" => "9",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Title Header 1", 'quanto'),
                "param_name" => "thead1",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Title Header 2", 'quanto'),
                "param_name" => "thead2",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Title Header 3", 'quanto'),
                "param_name" => "thead3",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Title Header 4", 'quanto'),
                "param_name" => "thead4",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Button Text 1", 'quanto'),
                "param_name" => "btntext",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Button Text 2", 'quanto'),
                "param_name" => "btn2",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

//Credit Card (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Credit Card", 'quanto'),
        "base" => "creditcard",
        'admin_enqueue_js'  => get_template_directory_uri() . '/inc/backend/js/select2.min.js',
        'admin_enqueue_css' => get_template_directory_uri() . '/inc/backend/css/select2.css',
        "class" => "",
        "icon" => "icon-st",
        "category" => 'Quanto Element',
        "params" => array(
            array(
                "type" => "dropdown",
                "heading" => esc_html__('Style', 'quanto'),
                "edit_field_class" => "vc_col-sm-6",
                "param_name" => "style",
                "value" => array(
                    esc_html__('Style 1', 'quanto')     => 'style1',
                    esc_html__('Style 2', 'quanto')     => 'style2',
                    esc_html__('Remotify', 'quanto')     => 'remotify',
                ),
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__('Columns', 'quanto'),
                "param_name" => "col",
                "dependency"  => array( 'element' => 'style', 'value' => 'style2'),
                "edit_field_class" => "vc_col-sm-6",
                "value" => array(
                    esc_html__('3 Columns', 'quanto')     => '3',
                    esc_html__('4 Columns', 'quanto')     => '4',
                    esc_html__('2 Columns', 'quanto')     => '2',
                ),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-6",
                "class" => "",
                "heading" => esc_html__("Number Posts", 'quanto'),
                "param_name" => "number",
                "value" => "9",
            ),
            array(
                "type"      => "select_projects_card",
                "holder"    => "div",
                "class"     => "",
                "heading"   => esc_html__("Credit Card List", 'quanto'),
                "param_name"=> "idpost",
                "value"     => "",
                "description" => esc_html__("Enter credit card name.", 'quanto')
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

if ( ! function_exists( 'is_plugin_active' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
    if ( function_exists( 'vc_add_shortcode_param' ) ) {
        vc_add_shortcode_param( 'select_projects_card', 'select_param_card', get_template_directory_uri() . '/inc/backend/js/select-field-card.js' );
    } elseif ( function_exists( 'add_shortcode_param' ) ) {
        add_shortcode_param( 'select_projects_card', 'select_param_card', get_template_directory_uri() . '/inc/backend/js/select-field-card.js' );
    }
}

function select_param_card( $settings, $value ) {
    $dependency = $settings;
    $args = array(
        'numberposts' => -1,
        'post_type'   => 'credit_card'
    );
    $posts = get_posts( $args );
    $cat = array();
    foreach( $posts as $post ) {
        if( $post ) {
            $cat[] = sprintf('<option value="%s">%s</option>',
                esc_attr( $post->ID ),
                $post->post_title
            );
        }

    }

    return sprintf(
        '<input type="hidden" name="%s" value="%s" class="wpb-input-card wpb_vc_param_value wpb-textinput %s %s_field" %s>
      <select class="select-card-post">
      %s
      </select>',
        esc_attr( $settings['param_name'] ),
        esc_attr( $value ),
        esc_attr( $settings['param_name'] ),
        esc_attr( $settings['type'] ),
        $dependency,
        implode( '', $cat )
    );

}

//Credit Card Compare (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Credit Card Compare", 'quanto'),
        "base" => "creditcom",
        "class" => "",
        "icon" => "icon-st",
        "category" => 'Quanto Element',
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Number Posts", 'quanto'),
                "param_name" => "num",
                "value" => "9",
            ),
            array(
                "type"      => "textfield",
                "holder"    => "div",
                "class"     => "",
                "heading"   => esc_html__("Credit Card Score Label", 'quanto'),
                "param_name"=> "credit_score",
                "value"     => "",
                "description" => esc_html__("Enter credit card score title.", 'quanto')
            ),
            array(
                "type"      => "textfield",
                "holder"    => "div",
                "class"     => "",
                "heading"   => esc_html__("Objects Label", 'quanto'),
                "param_name"=> "object_lb",
                "value"     => "",
                "description" => esc_html__("Enter object title.", 'quanto')
            ),
            array(
                "type"      => "textfield",
                "holder"    => "div",
                "class"     => "",
                "heading"   => esc_html__("Annual Fee Label", 'quanto'),
                "param_name"=> "annual_fee_lb",
                "value"     => "",
                "description" => esc_html__("Enter Annual Fee title.", 'quanto')
            ),
            array(
                "type"      => "textfield",
                "holder"    => "div",
                "class"     => "",
                "heading"   => esc_html__("Bouns Offer Label", 'quanto'),
                "param_name"=> "bouns_offer_lb",
                "value"     => "",
                "description" => esc_html__("Enter Bouns Offer title.", 'quanto')
            ),
            array(
                "type"      => "textfield",
                "holder"    => "div",
                "class"     => "",
                "heading"   => esc_html__("APR Label", 'quanto'),
                "param_name"=> "apr_lb",
                "value"     => "",
                "description" => esc_html__("Enter APR title.", 'quanto')
            ),
            array(
                "type"      => "textfield",
                "holder"    => "div",
                "class"     => "",
                "heading"   => esc_html__("Ongoing APR Label", 'quanto'),
                "param_name"=> "ongoing_apr_lb",
                "value"     => "",
                "description" => esc_html__("Enter ongoing APR title.", 'quanto')
            ),
            array(
                "type"      => "textfield",
                "holder"    => "div",
                "class"     => "",
                "heading"   => esc_html__("Earning Reward Label", 'quanto'),
                "param_name"=> "earn_re_lb",
                "value"     => "",
                "description" => esc_html__("Enter earning reward title.", 'quanto')
            ),
            array(
                "type"      => "textfield",
                "holder"    => "div",
                "class"     => "",
                "heading"   => esc_html__("Pros Label", 'quanto'),
                "param_name"=> "pros_lb",
                "value"     => "",
                "description" => esc_html__("Enter pros title.", 'quanto')
            ),
            array(
                "type"      => "textfield",
                "holder"    => "div",
                "class"     => "",
                "heading"   => esc_html__("Cons Label", 'quanto'),
                "param_name"=> "cons_lb",
                "value"     => "",
                "description" => esc_html__("Enter cons title.", 'quanto')
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

//Bank Account List (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Bank Account List", 'quanto'),
        "base" => "banklist",
        "class" => "",
        "icon" => "icon-st",
        "category" => 'Quanto Element',
        "params" => array(
            array(
                "type" => "dropdown",
                "heading" => esc_html__('Columns', 'quanto'),
                "param_name" => "col",
                "edit_field_class" => "vc_col-sm-6",
                "value" => array(
                    esc_html__('3 Columns', 'quanto')     => '3',
                    esc_html__('4 Columns', 'quanto')     => '4',
                    esc_html__('2 Columns', 'quanto')     => '2',
                ),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-6",
                "class" => "",
                "heading" => esc_html__("Number Posts", 'quanto'),
                "param_name" => "num",
                "value" => "6",
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__('Pattern', 'quanto'),
                "param_name" => "pattern",
                "edit_field_class" => "vc_col-sm-6",
                "value" => array(
                    esc_html__('None', 'quanto')     => 'none',
                    esc_html__('Pattern Bottom', 'quanto')     => 'card-pattern-bottom',
                    esc_html__('Pattern Top', 'quanto')     => 'card-pattern-top',
                    esc_html__('Pattern Left Bottom', 'quanto')     => 'card-pattern-left',
                    esc_html__('Pattern Left Top', 'quanto')     => 'card-pattern-left-top',
                    esc_html__('Pattern Right Bottom', 'quanto')     => 'card-pattern-right',
                    esc_html__('Pattern Right Top', 'quanto')     => 'card-pattern-right-top',
                    esc_html__('Pattern Full', 'quanto')     => 'card-pattern-full',
                ),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

//Bank Account Relate (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Bank Account Relate", 'quanto'),
        "base" => "bankrelate",
        "class" => "",
        "icon" => "icon-st",
        "category" => 'Quanto Element',
        "params" => array(
            array(
                "type" => "dropdown",
                "heading" => esc_html__('Columns', 'quanto'),
                "param_name" => "col",
                "edit_field_class" => "vc_col-sm-6",
                "value" => array(
                    esc_html__('3 Columns', 'quanto')     => '3',
                    esc_html__('4 Columns', 'quanto')     => '4',
                    esc_html__('2 Columns', 'quanto')     => '2',
                ),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-6",
                "class" => "",
                "heading" => esc_html__("Number Posts", 'quanto'),
                "param_name" => "num",
                "value" => "6",
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__('Pattern', 'quanto'),
                "param_name" => "pattern",
                "edit_field_class" => "vc_col-sm-6",
                "value" => array(
                    esc_html__('None', 'quanto')     => 'none',
                    esc_html__('Pattern Bottom', 'quanto')     => 'card-pattern-bottom',
                    esc_html__('Pattern Top', 'quanto')     => 'card-pattern-top',
                    esc_html__('Pattern Left Bottom', 'quanto')     => 'card-pattern-left',
                    esc_html__('Pattern Left Top', 'quanto')     => 'card-pattern-left-top',
                    esc_html__('Pattern Right Bottom', 'quanto')     => 'card-pattern-right',
                    esc_html__('Pattern Right Top', 'quanto')     => 'card-pattern-right-top',
                    esc_html__('Pattern Full', 'quanto')     => 'card-pattern-full',
                ),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

//Loan (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Loan List", 'quanto'),
        "base" => "ot_loanlist",
        "class" => "",
        "icon" => "icon-st",
        "category" => 'Quanto Element',
        "params" => array(
            array(
                "type" => "dropdown",
                "heading" => esc_html__('Columns', 'quanto'),
                "param_name" => "col",
                "edit_field_class" => "vc_col-sm-6",
                "value" => array(
                    esc_html__('3 Columns', 'quanto')     => '3',
                    esc_html__('4 Columns', 'quanto')     => '4',
                    esc_html__('2 Columns', 'quanto')     => '2',
                ),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-6",
                "class" => "",
                "heading" => esc_html__("Number Posts", 'quanto'),
                "param_name" => "num",
                "value" => "6",
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__('Pattern', 'quanto'),
                "param_name" => "pattern",
                "edit_field_class" => "vc_col-sm-6",
                "value" => array(
                    esc_html__('None', 'quanto')     => 'none',
                    esc_html__('Pattern Bottom', 'quanto')     => 'card-pattern-bottom',
                    esc_html__('Pattern Top', 'quanto')     => 'card-pattern-top',
                    esc_html__('Pattern Left Bottom', 'quanto')     => 'card-pattern-left',
                    esc_html__('Pattern Left Top', 'quanto')     => 'card-pattern-left-top',
                    esc_html__('Pattern Right Bottom', 'quanto')     => 'card-pattern-right',
                    esc_html__('Pattern Right Top', 'quanto')     => 'card-pattern-right-top',
                    esc_html__('Pattern Full', 'quanto')     => 'card-pattern-full',
                ),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

// Review box (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Review box", 'quanto'),
        "base" => "reviewbox",
        "class" => "",
        "category" => 'Quanto Element',
        "params" => array(
            array(
                "type" => "dropdown",
                "heading" => esc_html__('Review', 'quanto'),
                "param_name" => "style",
                "value" => array(
                    esc_html__('Style 1', 'quanto')     => 'style1',
                    esc_html__('Style 2', 'quanto')     => 'style2',
                    esc_html__('Style 3', 'quanto')     => 'style3',
                    esc_html__('Style 4', 'quanto')     => 'style4',
                ),
            ),
            array(
                'type' => 'dropdown',
                'value' => '',
                'heading' => esc_html__('Rate?', 'quanto'),
                'param_name' => 'review',
                "value" => array(
                    esc_html__('5 Star', 'quanto')   => '5star',
                    esc_html__('4.5 Star', 'quanto')   => '4s-half',
                    esc_html__('4 Star', 'quanto')   => '4star',
                    esc_html__('3.5 Star', 'quanto')   => '3s-half',
                    esc_html__('3 Star', 'quanto')   => '3star',
                    esc_html__('2.5 Star', 'quanto')   => '2s-half',
                    esc_html__('2 Star', 'quanto')   => '2star',
                    esc_html__('1.5 Star', 'quanto')   => '1s-half',
                    esc_html__('1 Star', 'quanto')   => '1star',
                    esc_html__('half Star', 'quanto')   => 'half',
                ),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Number Rate", 'quanto'),
                "param_name" => "num_rate",
                "dependency"  => array( 'element' => 'style', 'value' => array('style2','style1')),
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Rate text", 'quanto'),
                "dependency"  => array( 'element' => 'style', 'value' => 'style2'),
                "param_name" => "rate_text",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Date", 'quanto'),
                "dependency"  => array( 'element' => 'style', 'value' => array('style2','style3','style4')),
                "param_name" => "date",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Title", 'quanto'),
                "dependency"  => array( 'element' => 'style', 'value' => array('style2','style3','style4')),
                "param_name" => "title",
                "value" => "",
            ),
            array(
                "type" => "textarea",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Sub Title", 'quanto'),
                "dependency"  => array( 'element' => 'style', 'value' => array('style2','style3','style4')),
                "param_name" => "stitle",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Text Before Author Name", 'quanto'),
                "dependency"  => array( 'element' => 'style', 'value' => 'style4'),
                "param_name" => "text",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Author Name", 'quanto'),
                "dependency"  => array( 'element' => 'style', 'value' => array('style2','style3','style4')),
                "param_name" => "author",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Author Info", 'quanto'),
                "dependency"  => array( 'element' => 'style', 'value' => array('style2','style3')),
                "param_name" => "info",
                "value" => "",
            ),
            array(
                "type" => "vc_link",
                "holder" => "div",
                "heading" => esc_html__("Link", 'quanto'),
                "dependency"  => array( 'element' => 'style', 'value' => 'style1'),
                "param_name" => "link",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}

//Latest News (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Latest News", 'quanto'),
        "base" => "lastestnews",
        'admin_enqueue_js'  => get_template_directory_uri() . '/inc/backend/js/select2.min.js',
        'admin_enqueue_css' => get_template_directory_uri() . '/inc/backend/css/select2.css',
        "class" => "",
        "icon" => "icon-st",
        "category" => 'Quanto Element',
        "params" => array(
            array(
                "type" => "dropdown",
                "heading" => esc_html__('Style', 'quanto'),
                "param_name" => "style",
                "edit_field_class" => "vc_col-sm-6",
                "value" => array(
                    esc_html__('Style 1', 'quanto')     => 'style1',
                    esc_html__('Style 2', 'quanto')     => 'style2',
                    esc_html__('Style 3', 'quanto')     => 'style3',
                    esc_html__('Style 4', 'quanto')     => 'style4',
                ),
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__('Columns', 'quanto'),
                "param_name" => "show",
                "edit_field_class" => "vc_col-sm-6",
                "dependency"  => array( 'element' => 'style', 'value' => array('style1','style3','style4')),
                "value" => array(
                    esc_html__('3 Columns', 'quanto')     => '3',
                    esc_html__('4 Columns', 'quanto')     => '4',
                    esc_html__('2 Columns', 'quanto')     => '2',
                ),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "edit_field_class" => "vc_col-sm-6",
                "class" => "",
                "heading" => esc_html__("Number Posts", 'quanto'),
                "param_name" => "num",
                "value" => "3",
            ),
            array(         
                "type" => "textfield",         
                "holder" => "div",         
                "class" => "",         
                "heading" => "Order by :",         
                "edit_field_class" => "vc_col-sm-6",
                "param_name" => "orderby",         
                "value" => "",         
                "description" => __("Enter Order by. Example: title, date, rand ", 'quanto' )      
            ),  
            array(         
                "type" => "textfield",         
                "holder" => "div",         
                "class" => "",         
                "edit_field_class" => "vc_col-sm-6",
                "heading" => "Order : ",         
                "param_name" => "order",         
                "value" => "",         
                "description" => __("Enter Order. Example: DESC, ASC ", 'quanto' )      
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "edit_field_class" => "vc_col-sm-6",
                "heading" => esc_html__("Excerpt Length", 'quanto'),
                "param_name" => "excerpt",
                "dependency"  => array( 'element' => 'style', 'value' => 'style1'),
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "edit_field_class" => "vc_col-sm-6",
                "heading" => esc_html__("Text Before author name", 'quanto'),
                "param_name" => "text",
                "dependency"  => array( 'element' => 'style', 'value' => array('style3','style4') ),
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )));
}


// Logo Client (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Partner Logo", 'quanto'),
        "base" => "clients",
        "class" => "",
        "category" => 'Quanto Element',
        "icon" => "icon-st",
        "params" => array(
            array(
                'type' => 'dropdown',
                'value' => '',
                'heading' => esc_html__('Style', 'quanto'),
                'param_name' => 'style',
                "value" => array(
                    esc_html__('Style 1', 'quanto')   => 'style1',
                    esc_html__('Style 2', 'quanto')   => 'style2',
                    esc_html__('Style 3', 'quanto')   => 'style3',
                    esc_html__('Style 4', 'quanto')   => 'style4',
                    esc_html__('Style 5', 'quanto')   => 'style5',
                ),
            ),
            array(
                "type" => "attach_images",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Partner Logoes', 'quanto'),
                "param_name" => "gallery",
                "value" => "",
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => esc_html__('Column', 'quanto'),
                "param_name" => "show",
                "dependency"  => array( 'element' => 'style', 'value' => array('style1','style2','style3')),
                "value" => array(
                    esc_html__('6 Columns', 'quanto')     => '6',
                    esc_html__('5 Columns', 'quanto')     => '5',
                    esc_html__('4 Columns', 'quanto')     => '4',
                    esc_html__('3 Columns', 'quanto')     => '3',
                ),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )
    ));
}

// Logo Clients Style Hover (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Partner Logo Hover", 'quanto'),
        "base" => "clienthv",
        "class" => "",
        "category" => 'Quanto Element',
        "params" => array(
            array(
                'type' => 'dropdown',
                'value' => '',
                'heading' => esc_html__('Style', 'quanto'),
                'param_name' => 'style',
                "value" => array(
                    esc_html__('Style 1 (Outline box)', 'quanto')   => 'style1',
                    esc_html__('Style 2 (White box)', 'quanto')   => 'style2',
                ),
            ),
            array(
                'type' => 'param_group',
                'heading' => esc_html__("clients", 'quanto'),
                'value' => '',
                'param_name' => 'client',
                // Note params is mapped inside param-group:
                'params' => array(
                    array(
                        'type' => 'attach_image',
                        'value' => '',
                        'heading' => 'Logo',
                        'param_name' => 'photo',
                    ),
                    array(
                        'type' => 'attach_image',
                        'value' => '',
                        'heading' => 'Logo Hover',
                        'param_name' => 'photohv',
                    ),
                    array(
                        'type' => 'textfield',
                        'value' => '',
                        'heading' => esc_html__('Link out', 'quanto'),
                        'param_name' => 'link',
                    ),
                )
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => esc_html__('Column', 'quanto'),
                "param_name" => "show",
                "value" => array(
                    esc_html__('6 Columns', 'quanto')     => '6',
                    esc_html__('5 Columns', 'quanto')     => '5',
                    esc_html__('4 Columns', 'quanto')     => '4',
                    esc_html__('3 Columns', 'quanto')     => '3',
                ),
            ),
        )));
}

// Logo Block (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Logo Block", 'quanto'),
        "base" => "clientsblock",
        "class" => "",
        "category" => 'Quanto Element',
        "icon" => "icon-st",
        "params" => array(
            array(
                'type' => 'dropdown',
                'value' => '',
                'heading' => esc_html__('Style', 'quanto'),
                'param_name' => 'style',
                "value" => array(
                    esc_html__('Style 1', 'quanto')   => 'style1',
                    esc_html__('Style 2', 'quanto')   => 'style2',
                ),
            ),
            array(
                "type" => "attach_image",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Image', 'quanto'),
                "param_name" => "image",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Title', 'quanto'),
                "dependency"  => array( 'element' => 'style', 'value' => 'style2'),
                "param_name" => "title",
                "value" => "",
            ),
            array(
                "type" => "textarea_html",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Content', 'quanto'),
                "param_name" => "content",
                "value" => "",
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__('Pattern', 'quanto'),
                "param_name" => "parttern",
                "dependency"  => array( 'element' => 'style', 'value' => 'style1'),
                "value" => array(
                    esc_html__('None', 'quanto')     => 'none',
                    esc_html__('Pattern Bottom', 'quanto')     => 'card-pattern-bottom',
                    esc_html__('Pattern Top', 'quanto')     => 'card-pattern-top',
                    esc_html__('Pattern Left Bottom', 'quanto')     => 'card-pattern-left',
                    esc_html__('Pattern Left Top', 'quanto')     => 'card-pattern-left-top',
                    esc_html__('Pattern Right Bottom', 'quanto')     => 'card-pattern-right',
                    esc_html__('Pattern Right Top', 'quanto')     => 'card-pattern-right-top',
                    esc_html__('Pattern Full', 'quanto')     => 'card-pattern-full',
                ),
            ),
            array(
                "type" => "vc_link",
                "holder" => "div",
                "heading" => esc_html__("Link", 'quanto'),
                "dependency"  => array( 'element' => 'style', 'value' => 'style1'),
                "param_name" => "link",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )
    ));
}

// Image Carousel (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Image Carousel", 'quanto'),
        "base" => "imgowl",
        "class" => "",
        "category" => 'Quanto Element',
        "icon" => "icon-st",
        "params" => array(
            array(
                "type" => "attach_images",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Image', 'quanto'),
                "param_name" => "gallery",
                "value" => "",
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => esc_html__('Column', 'quanto'),
                "param_name" => "show",
                "value" => array(
                    esc_html__('3 Columns', 'quanto')     => '3',
                    esc_html__('2 Columns', 'quanto')     => '2',
                    esc_html__('4 Columns', 'quanto')     => '4',
                    esc_html__('5 Columns', 'quanto')     => '5',
                    esc_html__('6 Columns', 'quanto')     => '6',
                ),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Auto play", 'quanto'),
                "param_name" => "auto",
                "value" => "auto",
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Arrow", 'quanto'),
                "param_name" => "arr",
                "value" => array(
                    esc_html__('True', 'quanto') => 'true',
                    esc_html__('False ', 'quanto') => 'false',
                ),
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Dots", 'quanto'),
                "param_name" => "dots",
                "value" => array(
                    esc_html__('True', 'quanto') => 'true',
                    esc_html__('False ', 'quanto') => 'false',
                ),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            ),
        )
    ));
}

//Categories box (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Categories Box", 'quanto'),
        "base" => "catbox",
        "class" => "",
        "category" => 'Quanto Element',
        "params" => array(
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => esc_html__('Style', 'quanto'),
                "param_name" => "style",
                "value" => array(
                    esc_html__('Style Image', 'quanto')     => 'style1',
                    esc_html__('Style Icon', 'quanto')     => 'style2',
                ),
            ),
            array(
                "type" => "attach_image",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Icon Image', 'quanto'),
                "param_name" => "image",
                "dependency"  => array( 'element' => 'style', 'value' => 'style1'),
                "value" => "",
            ),
            array(
                "type" => "iconpicker",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Icon', 'quanto'),
                "param_name" => "icon",
                "dependency"  => array( 'element' => 'style', 'value' => 'style2'),
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Title', 'quanto'),
                "param_name" => "title",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Link', 'quanto'),
                "dependency"  => array( 'element' => 'style', 'value' => 'style2'),
                "param_name" => "link_cat",
                "value" => "",
            ),
            array(
                "type" => "textarea_html",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Content', 'quanto'),
                "param_name" => "content",
                "dependency"  => array( 'element' => 'style', 'value' => 'style1'),
                "value" => "",
            ),
            array(
                "type" => "vc_link",
                "holder" => "div",
                "class" => "",
                "dependency"  => array( 'element' => 'style', 'value' => 'style1'),
                "heading" => esc_html__('Link', 'quanto'),
                "param_name" => "link",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Extra Class', 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            )
        )
    ));
}

//Services box (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Services Box", 'quanto'),
        "base" => "service",
        "class" => "",
        "category" => 'Quanto Element',
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Icon', 'quanto'),
                "param_name" => "icon",
                "value" => "",
                "description" => __("Ex: icon-003-id-card. Find here <a target='_blank' href='http://wpdemo2.oceanthemes.net/quanto/flat-icon/'>http://wpdemo2.oceanthemes.net/quanto/flat-icon/</a>.",'quanto')
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Color', 'quanto'),
                "param_name" => "color",
                "value" => "",
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Background Color', 'quanto'),
                "param_name" => "bg_color",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Title', 'quanto'),
                "param_name" => "title",
                "value" => "",
            ),
            array(
                "type" => "textarea_html",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Content', 'quanto'),
                "param_name" => "content",
                "value" => "",
            ),
            array(
                "type" => "vc_link",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Link', 'quanto'),
                "param_name" => "link",
            ),
            array(
                "type" => "attach_image",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Background Bottom', 'quanto'),
                "param_name" => "bg",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Extra Class', 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            )
        )
    ));
}

// Slider Box (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Slider Box", 'quanto'),
        "base" => "slidecatbox",
        "class" => "",
        "category" => 'Quanto Element',
        "params" => array(
            array(
                'type' => 'param_group',
                'heading' => esc_html__("Slide", 'quanto'),
                'value' => '',
                'param_name' => 'slide',
                // Note params is mapped inside param-group:
                'params' => array(
                    array(
                        'type' => 'iconpicker',
                        'value' => '',
                        'heading' => esc_html__('Icon', 'quanto'),
                        'param_name' => 'icon',
                    ),
                    array(
                        "type" => "colorpicker",
                        "heading" => esc_html__("Color icon", 'quanto'),
                        "param_name" => "color",
                        "value" => "",
                    ),
                    array(
                        "type" => "colorpicker",
                        "heading" => esc_html__("Backgound Color Icon", 'quanto'),
                        "param_name" => "bg_color",
                        "value" => "",
                    ),
                    array(
                        'type' => 'textfield',
                        'value' => '',
                        'heading' => esc_html__('Title', 'quanto'),
                        'param_name' => 'title',
                    ),
                    array(
                        'type' => 'textfield',
                        'value' => '',
                        'heading' => esc_html__('Subtitle', 'quanto'),
                        'param_name' => 'stitle',
                    ),
                    array(
                        'type' => 'textfield',
                        'value' => '',
                        'heading' => esc_html__('Button text', 'quanto'),
                        'param_name' => 'btn',
                    ),
                    array(
                        'type' => 'textfield',
                        'value' => '',
                        'heading' => esc_html__('Link', 'quanto'),
                        'param_name' => 'link',
                    ),
                )
            ),
        )));
}

//Video Player (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Video Player", 'quanto'),
        "base" => "videopl",
        "class" => "",
        "category" => 'Quanto Element',
        "params" => array(
            array(
                "type" => "attach_image",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Poster', 'quanto'),
                "param_name" => "image",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Link Video', 'quanto'),
                "param_name" => "link",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Title', 'quanto'),
                "param_name" => "title",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Extra Class', 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            )
        )
    ));
}

//Alert (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Alert", 'quanto'),
        "base" => "alert",
        "class" => "",
        "category" => 'Quanto Element',
        "params" => array(
            array(
                "type" => "dropdown",
                "heading" => esc_html__('Style', 'quanto'),
                "param_name" => "style",
                "value" => array(
                    esc_html__('Alert Primary', 'quanto')     => 'alert-primary',
                    esc_html__('Alert Secondary', 'quanto')     => 'alert-secondary',
                    esc_html__('Alert Success', 'quanto')     => 'alert-success',
                    esc_html__('Alert Danger', 'quanto')     => 'alert-danger',
                    esc_html__('Alert Warning', 'quanto')     => 'alert-warning',
                    esc_html__('Alert Info', 'quanto')     => 'alert-info',
                    esc_html__('Alert Light', 'quanto')     => 'alert-light',
                    esc_html__('Alert Dark', 'quanto')     => 'alert-dark',
                    esc_html__('Custom Style', 'quanto')     => 'alert-custom',
                ),
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Color Text", 'quanto'),
                "param_name" => "color",
                "dependency"  => array( 'element' => 'style', 'value' => 'alert-custom' ),
                "value" => "",
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "heading" => esc_html__("Backgound Color", 'quanto'),
                "param_name" => "bg_color",
                "dependency"  => array( 'element' => 'style', 'value' => 'alert-custom' ),
                "value" => "",
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__("Border Color", 'quanto'),
                "param_name" => "bo_color",
                "dependency"  => array( 'element' => 'style', 'value' => 'alert-custom' ),
                "value" => "",
            ),
            array(
                "type" => "textarea_html",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Content', 'quanto'),
                "param_name" => "content",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Extra Class', 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            )
        )
    ));
}
//Contact Info (quanto)
if(function_exists('vc_map')){
    vc_map( array(
        "name" => esc_html__("OT Contact Info", 'quanto'),
        "base" => "cinfo",
        "class" => "",
        "category" => 'Quanto Element',
        "params" => array(
            array(
                "type" => "iconpicker",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Icon', 'quanto'),
                "param_name" => "icon",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Title', 'quanto'),
                "param_name" => "title",
                "value" => "",
            ),
            array(
                "type" => "textarea_html",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Content', 'quanto'),
                "param_name" => "content",
                "value" => "",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__('Extra Class', 'quanto'),
                "param_name" => "iclass",
                "value" => "",
            )
        )
    ));
}


if ( ! function_exists( 'is_plugin_active' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
    if ( function_exists( 'vc_add_shortcode_param' ) ) {
        vc_add_shortcode_param( 'select_projects', 'select_param_project', get_template_directory_uri() . '/inc/backend/js/select-field-project.js' );
    } elseif ( function_exists( 'add_shortcode_param' ) ) {
        add_shortcode_param( 'select_projects', 'select_param_project', get_template_directory_uri() . '/inc/backend/js/select-field-project.js' );
    }
}

function select_param_project( $settings, $value ) {
    $dependency = $settings;
    $args = array(
        'numberposts' => -1,
        'post_type'   => 'ot_help_center'
    );
    $posts = get_posts( $args );
    $cat = array();
    foreach( $posts as $post ) {
        if( $post ) {
            $cat[] = sprintf('<option value="%s">%s</option>',
                esc_attr( $post->ID ),
                $post->post_title
            );
        }

    }

    return sprintf(
        '<input type="hidden" name="%s" value="%s" class="wpb-input-projects wpb_vc_param_value wpb-textinput %s %s_field" %s>
      <select class="select-projects-post">
      %s
      </select>',
        esc_attr( $settings['param_name'] ),
        esc_attr( $value ),
        esc_attr( $settings['param_name'] ),
        esc_attr( $settings['type'] ),
        $dependency,
        implode( '', $cat )
    );

}

if ( ! function_exists( 'is_plugin_active' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
    if ( function_exists( 'vc_add_shortcode_param' ) ) {
        vc_add_shortcode_param( 'select_cate', 'select_param', get_template_directory_uri() . '/inc/backend/js/select-field-help.js' );
    } elseif ( function_exists( 'add_shortcode_param' ) ) {
        add_shortcode_param( 'select_cate', 'select_param', get_template_directory_uri() . '/inc/backend/js/select-field-help.js' );
    }
}

function select_param( $settings, $value ) {
  $categories = get_terms( 'help_center_cat' );
  $cat_help = array();
  foreach( $categories as $category ) {
     if( $category ) {
        $cat_help[] = sprintf('<option value="%s">%s</option>',
           esc_attr( $category->slug ),
           $category->name
        );
     }

  }

  return sprintf(
     '<input type="hidden" name="%s" value="%s" class="wpb-input-help wpb_vc_param_value wpb-textinput %s %s_field">
     <select class="select-categories-help">
     %s
     </select>',
     esc_attr( $settings['param_name'] ),
     esc_attr( $value ),
     esc_attr( $settings['param_name'] ),
     esc_attr( $settings['type'] ),
     implode( '', $cat_help )
  );
}
