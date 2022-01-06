<?php
/**
 * Registering meta boxes
 *
 * Using Meta Box plugin: http://www.deluxeblogtips.com/meta-box/
 *
 * @see https://docs.metabox.io/
 *
 * @param array $meta_boxes Default meta boxes. By default, there are no meta boxes.
 *
 * @return array All registered meta boxes
 */
function quanto_register_meta_boxes( $meta_boxes ) {
	// Post format's meta box
	$meta_boxes[] = array(
		'id'       => 'format_detail',
		'title'    => esc_html__( 'Format Details', 'quanto' ),
		'pages'    => array( 'post' ),
		'context'  => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields'   => array(
			array(
				'name'             => esc_html__( 'Image', 'quanto' ),
				'id'               => 'image',
				'type'             => 'image_advanced',
				'class'            => 'image',
				'max_file_uploads' => 1,
			),
			array(
				'name'  => esc_html__( 'Gallery', 'quanto' ),
				'id'    => 'images',
				'type'  => 'image_advanced',
				'class' => 'gallery',
			),			
			array(				
				'name'  => esc_html__( 'Audio', 'quanto' ),
				'id'    => 'link_audio', // How to display on front end: https://metabox.io/docs/get-meta-value/
				'type'  => 'oembed',
				// Allow to clone? Default is false
				'clone' => false,
				// Input size
				'size'  => 30,
				'class' => 'audio',
				'desc' => 'Example: https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/139083759',
			),
			array(
				'name'  => esc_html__( 'Quote', 'quanto' ),
				'id'    => 'quote',
				'type'  => 'textarea',
				'cols'  => 20,
				'rows'  => 2,
				'class' => 'quote',
			),
			array(
				'name'  => esc_html__( 'Author', 'quanto' ),
				'id'    => 'quote_author',
				'type'  => 'text',
				'class' => 'quote',
			),
			array(
				'name'  => esc_html__( 'Video', 'quanto' ),
				'id'    => 'link_video', // How to display on front end: https://metabox.io/docs/get-meta-value/
				'type'  => 'oembed',
				// Allow to clone? Default is false
				'clone' => false,
				// Input size
				'size'  => 30,
				'class' => 'video',
				'desc' => 'Example: <b>http://www.youtube.com/embed/0ecv0bT9DEo</b> or <b>http://player.vimeo.com/video/47355798</b>',
			),		
		),
	);

    $meta_boxes[] = array(
        'id'       => 'page-settings',
        'title'    => esc_html__( 'Page Settings', 'quanto' ),
        'pages'    => array( 'page','loan','team','ot_lenders','bank_account','credit_card','ot_mortgage','ot_help_center' ),
        'context'  => 'normal',
        'priority' => 'high',
        'autosave' => true,
        'fields'   => array(
            array(
                'type' => 'heading',
                'name' => 'Page Layout',
            ),
            array(
                'id'       => 'page_layout',
                'name'     => 'Layout',
                'type'     => 'image_select',
                'options'  => array(
                    'full-content'    => get_template_directory_uri() . '/inc/backend/images/full.png',
                    'content-sidebar' => get_template_directory_uri() . '/inc/backend/images/right.png',
                    'sidebar-content' => get_template_directory_uri() . '/inc/backend/images/left.png',
                ),
                'std'      => 'full-content'
            ),
            array(
                'type' => 'heading',
                'name' => 'Page Header',
            ),
            array(
                'name'             => esc_html__( 'Page Header On/Off?', 'quanto' ),
                'id'               => 'pheader_switch',
                'type'             => 'switch',
                'style'            => 'rounded',
                'on_label'         => 'On',
                'off_label'        => 'Off',
                'std'              => 'on'
            ),
            array(
                'name'             => esc_html__( 'Page Header Style', 'quanto' ),
                'id'               => 'pheader_type',
                'type'             => 'select',
                'class'            => '',
                'options'  => array(
                    'style1'     => esc_html__( 'Style 1', 'quanto' ),
                    'style2'     => esc_html__( 'Style 2', 'quanto' ),
                ),
                'std'      => 'style1'
            ),
            array(
                'name'             => esc_html__( 'Background Image Page Header', 'quanto' ),
                'id'               => 'pheader_bg_image',
                'type'             => 'image_advanced',
                'class'            => '',
                'max_file_uploads' => 1,
            ),
            array(
                'name'             => esc_html__( 'Subtitle Page Header', 'quanto' ),
                'id'               => 'pheader_sub',
                'type'             => 'textarea',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Button Text 1 Subheader', 'quanto' ),
                'id'               => 'btext1',
                'type'             => 'text',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Button Link 1 Subheader', 'quanto' ),
                'id'               => 'blink1',
                'type'             => 'text',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Button Text 2 Subheader', 'quanto' ),
                'id'               => 'btext2',
                'type'             => 'text',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Button Link 2 Subheader', 'quanto' ),
                'id'               => 'blink2',
                'type'             => 'text',
                'class'            => '',
            ),
        ),
    );

    $meta_boxes[] = array(
        'id'       => 'team-settings',
        'title'    => esc_html__( 'Team Settings', 'quanto' ),
        'pages'    => array( 'team' ),
        'context'  => 'normal',
        'priority' => 'high',
        'autosave' => true,
        'fields'   => array(
            array(
                'name'             => esc_html__( 'Job', 'quanto' ),
                'id'               => 'job',
                'type'             => 'text',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Description', 'quanto' ),
                'id'               => 'desc_mem',
                'type'             => 'textarea',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Email Address', 'quanto' ),
                'id'               => 'email',
                'type'             => 'text',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Number Phone', 'quanto' ),
                'id'               => 'phone',
                'type'             => 'text',
                'class'            => '',
            )
        ),
    );

    $meta_boxes[] = array(
        'id'       => 'lender-settings',
        'title'    => esc_html__( 'Lenders Settings', 'quanto' ),
        'pages'    => array( 'ot_lenders' ),
        'context'  => 'normal',
        'priority' => 'high',
        'autosave' => true,
        'fields'   => array(
            array(
                'name' => esc_html__( 'Description', 'quanto' ),
                'desc' => esc_html__( 'Add description for "OT Credit Card" style 2 element.', 'quanto' ),
                'id'   => 'desc',
                'type' => 'textarea',
            ),
            array(
                'name' => esc_html__( 'Short Content', 'quanto' ),
                'desc' => esc_html__( 'Add short content for "OT Credit Card" for style 1 element.', 'quanto' ),
                'id'   => 'shortcont',
                'type' => 'wysiwyg',
            ),
            array(
                'name'             => esc_html__( 'Review', 'quanto' ),
                'id'               => 'review',
                'type'             => 'select',
                'desc'             => esc_html__( 'select review for "OT Credit Card" style 1 element.', 'quanto' ),
                'class'            => '',
                'options'  => array(
                    'half'     => esc_html__( 'Half Star', 'quanto' ),
                    '1star'     => esc_html__( '1 Star', 'quanto' ),
                    '1s-half'     => esc_html__( '1.5 Star', 'quanto' ),
                    '2star'     => esc_html__( '2 Star', 'quanto' ),
                    '2s-half'     => esc_html__( '2.5 Star', 'quanto' ),
                    '3star'     => esc_html__( '3 Star', 'quanto' ),
                    '3s-half'     => esc_html__( '3.5 Star', 'quanto' ),
                    '4star'     => esc_html__( '4 Star', 'quanto' ),
                    '4s-half'     => esc_html__( '4.5 Star', 'quanto' ),
                    '5star'     => esc_html__( '5 Star', 'quanto' ),
                ),
                'std'      => '5star'
            ),
            array(
                'name'             => esc_html__( 'Number Of Reviews', 'quanto' ),
                'id'               => 'number',
                'desc'              => esc_html__( 'Enter the number review text for "OT Credit Card" style 1 element.', 'quanto' ),
                'type'             => 'text',
                'class'            => '',
            ),
        ),
    );

    $meta_boxes[] = array(
        'id'       => 'lender-rate-settings',
        'title'    => esc_html__( 'Lenders Rate Detail', 'quanto' ),
        'pages'    => array( 'ot_lenders' ),
        'context'  => 'normal',
        'priority' => 'high',
        'autosave' => true,
        'fields'   => array(
            array(
                'name'             => esc_html__( 'Lender APR Value', 'quanto' ),
                'id'               => 'lender_apr',
                'type'             => 'text',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Lender Rate Text', 'quanto' ),
                'id'               => 'lender_rate_text',
                'type'             => 'text',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Lender Rate Value', 'quanto' ),
                'id'               => 'lender_rate_value',
                'type'             => 'text',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Lender Fee Text', 'quanto' ),
                'id'               => 'lender_fee_text',
                'type'             => 'text',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Lender Fee Alt Title', 'quanto' ),
                'id'               => 'lender_fee_alt',
                'type'             => 'textarea',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Lender Fee Value', 'quanto' ),
                'id'               => 'lender_fee_value',
                'type'             => 'text',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Lender Payment Text', 'quanto' ),
                'id'               => 'lender_payment_text',
                'type'             => 'text',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Lender Payment', 'quanto' ),
                'id'               => 'lender_payment',
                'type'             => 'text',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Hotline', 'quanto' ),
                'id'               => 'lender_hotline',
                'type'             => 'text',
                'class'            => '',
            ),
        ),
    );

    $meta_boxes[] = array(
        'id'       => 'credit-card-settings',
        'title'    => esc_html__( 'Credit Card Settings', 'quanto' ),
        'pages'    => array( 'credit_card' ),
        'context'  => 'normal',
        'priority' => 'high',
        'autosave' => true,
        'fields'   => array(
            array(
                'name'             => esc_html__( 'Description', 'quanto' ),
                'id'               => 'desc',
                'type'             => 'textarea',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Disclosure Text', 'quanto' ),
                'id'               => 'disclosure',
                'type'             => 'text',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Reviews Title', 'quanto' ),
                'id'               => 'reviewtit',
                'type'             => 'text',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Review', 'quanto' ),
                'id'               => 'review',
                'type'             => 'select',
                'class'            => '',
                'options'  => array(
                    'half'     => esc_html__( 'Half Star', 'quanto' ),
                    '1star'     => esc_html__( '1 Star', 'quanto' ),
                    '1s-half'     => esc_html__( '1.5 Star', 'quanto' ),
                    '2star'     => esc_html__( '2 Star', 'quanto' ),
                    '2s-half'     => esc_html__( '2.5 Star', 'quanto' ),
                    '3star'     => esc_html__( '3 Star', 'quanto' ),
                    '3s-half'     => esc_html__( '3.5 Star', 'quanto' ),
                    '4star'     => esc_html__( '4 Star', 'quanto' ),
                    '4s-half'     => esc_html__( '4.5 Star', 'quanto' ),
                    '5star'     => esc_html__( '5 Star', 'quanto' ),
                ),
                'std'      => '5star'
            ),
            array(
                'name'             => esc_html__( 'Number Reviews', 'quanto' ),
                'id'               => 'reviewtext',
                'type'             => 'text',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Value 1', 'quanto' ),
                'id'               => 'value1',
                'type'             => 'text',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Value 2', 'quanto' ),
                'id'               => 'value2',
                'type'             => 'text',
                'class'            => '',
            ),
            array(
                'name' => esc_html__( 'Short Content', 'quanto' ),
                'desc' => esc_html__( 'Add short content for "OT Credit Card" element.', 'quanto' ),
                'id'   => 'shortcont',
                'type' => 'wysiwyg',
            ),
            array(
                'name'             => esc_html__( 'Button Text 1', 'quanto' ),
                'id'               => 'btn1',
                'type'             => 'text',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Link 1', 'quanto' ),
                'id'               => 'link1',
                'type'             => 'text',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Button Text 2', 'quanto' ),
                'id'               => 'btn2',
                'type'             => 'text',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Link 2', 'quanto' ),
                'id'               => 'link2',
                'type'             => 'text',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Regular APR Label', 'quanto' ),
                'id'               => 'regular_apr',
                'type'             => 'text',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Regular APR Value', 'quanto' ),
                'id'               => 'regular_apr_value',
                'type'             => 'text',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Annual Fee Label', 'quanto' ),
                'id'               => 'annual_fee',
                'type'             => 'text',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Annual Fee Value', 'quanto' ),
                'id'               => 'annual_fee_value',
                'type'             => 'text',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Purchase Intro APR Label', 'quanto' ),
                'id'               => 'purchase_intro',
                'type'             => 'text',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Purchase Intro APR Value', 'quanto' ),
                'id'               => 'purchase_intro_value',
                'type'             => 'text',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Balance Transfer Intro APR Label', 'quanto' ),
                'id'               => 'balance_transfer_intro',
                'type'             => 'text',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Balance Transfer Intro APR Value', 'quanto' ),
                'id'               => 'balance_transfer_intro_value',
                'type'             => 'text',
                'class'            => '',
            ),
        ),
    );

    $meta_boxes[] = array(
        'id'       => 'credit-card-score-settings',
        'title'    => esc_html__( 'Recommended Credit Score', 'quanto' ),
        'pages'    => array( 'credit_card' ),
        'context'  => 'normal',
        'priority' => 'high',
        'autosave' => true,
        'fields'   => array(
            array(
                'name'             => esc_html__( 'Credit Score Title', 'quanto' ),
                'id'               => 'score_tt',
                'type'             => 'text',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Credit Score Text', 'quanto' ),
                'id'               => 'score_tx',
                'type'             => 'text',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Credit Score Info', 'quanto' ),
                'id'               => 'score_if',
                'type'             => 'text',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Credit Score Progress Bar', 'quanto' ),
                'id'               => 'score_pb',
                'type'             => 'text',
                'class'            => '',
            ),
            array(
                'name' => esc_html__( 'Short Content Object', 'quanto' ),
                'desc' => esc_html__( 'Add short content for "OT Credit Card Compare" element.', 'quanto' ),
                'id'   => 'objects_for',
                'type' => 'wysiwyg',
            ),
            array(
                'name'             => esc_html__( 'Bouns Offer', 'quanto' ),
                'id'               => 'bouns_off',
                'type'             => 'textarea',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'APR', 'quanto' ),
                'id'               => 'apr',
                'type'             => 'textarea',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Ongoing APR', 'quanto' ),
                'id'               => 'ongoing_apr',
                'type'             => 'textarea',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Earning Rewards', 'quanto' ),
                'id'               => 'earning_rew',
                'type'             => 'textarea',
                'class'            => '',
            ),
            array(
                'name' => esc_html__( 'Pros', 'quanto' ),
                'desc' => esc_html__( 'Add short content for "OT Credit Card Compare" element.', 'quanto' ),
                'id'   => 'pros',
                'type' => 'wysiwyg',
            ),
            array(
                'name' => esc_html__( 'Cons', 'quanto' ),
                'desc' => esc_html__( 'Add short content for "OT Credit Card Compare" element.', 'quanto' ),
                'id'   => 'cons',
                'type' => 'wysiwyg',
            ),
        ),
    );

    $meta_boxes[] = array(
        'id'       => 'mortgage-settings',
        'title'    => esc_html__( 'Mortgage Settings', 'quanto' ),
        'pages'    => array( 'ot_mortgage' ),
        'context'  => 'normal',
        'priority' => 'high',
        'autosave' => true,
        'fields'   => array(
            array(
                'name'             => esc_html__( 'Description', 'quanto' ),
                'id'               => 'desc_mortgage',
                'type'             => 'textarea',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Icon', 'quanto' ),
                'id'               => 'icon',
                'type'             => 'text',
                'class'            => '',
                'desc' => 'Example: <i class="icon-008-mortgage"></i> Find here:  <b>http://wpdemo2.oceanthemes.net/quanto/icon-font/</b>',
            ),
        ),
    );

    $meta_boxes[] = array(
        'id'       => 'loan-settings',
        'title'    => esc_html__( 'loan Settings', 'quanto' ),
        'pages'    => array( 'loan' ),
        'context'  => 'normal',
        'priority' => 'high',
        'autosave' => true,
        'fields'   => array(
            array(
                'name'             => esc_html__( 'Icon', 'quanto' ),
                'id'               => 'icon',
                'type'             => 'text',
                'class'            => '',
                'desc' => 'Example: <i class="icon-002-wallet"></i> Find here:  <b>http://wpdemo2.oceanthemes.net/quanto/icon-font/</b>',
            ),
            array(
                'name'             => esc_html__( 'Description', 'quanto' ),
                'id'               => 'desc_loan',
                'type'             => 'textarea',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Button text 1', 'quanto' ),
                'id'               => 'btn',
                'type'             => 'text',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Button link 1', 'quanto' ),
                'id'               => 'link',
                'type'             => 'text',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Button text 2', 'quanto' ),
                'id'               => 'btn2',
                'type'             => 'text',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Button link 2', 'quanto' ),
                'id'               => 'link2',
                'type'             => 'text',
                'class'            => '',
            )
        ),
    );

    $meta_boxes[] = array(
        'id'       => 'bank-account-settings',
        'title'    => esc_html__( 'Bank Account Settings', 'quanto' ),
        'pages'    => array( 'bank_account' ),
        'context'  => 'normal',
        'priority' => 'high',
        'autosave' => true,
        'fields'   => array(
            array(
                'name'             => esc_html__( 'Description', 'quanto' ),
                'id'               => 'desc_bank',
                'type'             => 'textarea',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Button text 1', 'quanto' ),
                'id'               => 'btn',
                'type'             => 'text',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Button link 1', 'quanto' ),
                'id'               => 'link',
                'type'             => 'text',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Button text 2', 'quanto' ),
                'id'               => 'btn2',
                'type'             => 'text',
                'class'            => '',
            ),
            array(
                'name'             => esc_html__( 'Button link 2', 'quanto' ),
                'id'               => 'link2',
                'type'             => 'text',
                'class'            => '',
            )
        ),
    );


	return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'quanto_register_meta_boxes' );