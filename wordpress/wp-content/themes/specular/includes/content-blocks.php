<?php

add_filter( 'vc_get_all_templates', 'codeless_modify_default_template_name', 999 );
function codeless_modify_default_template_name($data){
    $data[1]['category_name'] = esc_attr__('Specular Templates','specular');
    $data[1]['category_description'] = esc_attr__( 'Append predefined Specular Templates to the actual layout', 'specular' );
    $default_templates = visual_composer()->templatesPanelEditor()->getDefaultTemplates();

    foreach( $data[1]['templates'] as $index => $template_data ){
        if( isset( $template_data['unique_id'] ) && isset( $default_templates[ $template_data['unique_id'] ] ) ){
            
            $data[1]['templates'][$index]['cat_display_name'] = isset( $default_templates[ $template_data['unique_id'] ]['cat_display_name'] ) ? $default_templates[$template_data['unique_id']]['cat_display_name'] : '';
        }
    }
    $data[1]['category_weight'] = 5;

    return $data;
    
}


add_filter( 'vc_templates_render_category', 'codeless_templates_render_category', 999 );
function codeless_templates_render_category($category){
    if( $category['category'] == 'default_templates' ){
        $output = $category['output'];
        $category['output'] = '<div class="library_categories">';
            $category['output'] .= '<ul>';
            $codeless_library_cats = codeless_vc_cat_list();
            $category['output'] .=  '<li data-sort="all" class="active">'.esc_attr__('All','specular').'</li>';
            foreach($codeless_library_cats as $cat_id => $cat_name) {
                $category['output'] .=  '<li data-sort="'.$cat_id.'">'.$cat_name.'</li>';
            }
            $category['output'] .= '</ul>';

        $category['output'] .= '</div>';
        $category['output'] .= '<div class="cl-templates-wrap">';
        $category['output'] .= $output;
        $category['output'] .= '</div>';
    }

    return $category;
}


add_filter( 'vc_templates_render_template', 'codeless_templates_render_template', 99, 2 );
function codeless_templates_render_template($name, $template){
    $name = $template['name'];
    $cat_display_name = isset( $template['cat_display_name'] ) ? $template['cat_display_name'] : '';

    $output = '';
    $output .= '<div class="cl-template-wrap">';
        if( isset( $template['image'] ) && !empty(  $template['image'] ) )
            $output .= '<div class="img-wrap"><img class="lazy" data-src="'.$template['image'].'" alt="'.$name.'" width="300" height="200"></div>';
        $output .= '<div class="title-wrap">';
            $output .= '<div class="display_cat">'.$cat_display_name.'</div>';
            $output .= $name;
        $output .= '</div>';
        $output .= '<a type="button" class="vc_ui-list-bar-item-trigger" title="$add_template_title"
    data-template-handler=""
    data-vc-ui-element="template-title"></a>';
    $output .= '</div>';
    return $output;
}


add_action( 'vc_load_default_templates_action','codeless_templates_for_vc' ); 

function codeless_vc_cat_list(){
    $cat_display_names = array(
		'block' => esc_html__('Block','specular'),
		'blog' => esc_html__('Blog','specular'),
		'cta' => esc_html__('Call to Action','specular'),
		'contact' => esc_html__('Contact','specular'),
		'counter' => esc_html__('Counter','specular'),
        'clients' => esc_html__('Clients','specular'),
        'faq' => esc_html__('FAQ','specular'),
		'grid' => esc_html__('Grid','specular'),
		'gallery' => esc_html__('Gallery','specular'),
        'portfolio' => esc_html__('Portfolio','specular'),
        'price' => esc_html__('Price List','specular'),
		'services' => esc_html__('Services','specular'),
		'skills' => esc_html__('Skills','specular'),
		'testimonial' => esc_html__('Testimonial','specular'),
        'team' => esc_html__('Team','specular'),
        'tabs' => esc_html__('Tabs','specular'),
        'toggles' => esc_html__('Toggles','specular'),
    );

    return $cat_display_names;
}


function codeless_templates_for_vc() {

$cat_display_names = codeless_vc_cat_list();

$data = array();
$data['name'] = esc_html__( 'Fullwidth Block with Image and Text', 'specular' );
$data['cat_display_name'] = $cat_display_names['block']; 
$data['custom_class'] = 'block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/123.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_content"][vc_column width="1/2" background_image="67" css=".vc_custom_1552385468699{padding-top: 35px !important;padding-right: 30px !important;padding-bottom: 25px !important;padding-left: 30px !important;background-color: #f9f9f9 !important;}"][/vc_column][vc_column width="1/2" css=".vc_custom_1552385540274{padding-top: 50px !important;padding-right: 10% !important;padding-bottom: 50px !important;padding-left: 50px !important;}"][vc_custom_heading text="WELCOME TO SPECULAR" font_container="tag:h2|font_size:16px|text_align:left|color:%231c1c1c|line_height:24px" google_fonts="font_family:Roboto%3A100%2C100italic%2C300%2C300italic%2Cregular%2Citalic%2C500%2C500italic%2C700%2C700italic%2C900%2C900italic|font_style:300%20light%20regular%3A300%3Anormal" letter_space="6px" css=".vc_custom_1552388658536{margin-bottom: 0px !important;}"][vc_custom_heading text="Restaurants & Bars" font_container="tag:h2|font_size:36px|text_align:left|color:%231c1c1c|line_height:48px" use_theme_fonts="yes"][separator width="60px" height="1px" color="#c1a24d" margin_bottom="35px"][vc_column_text]On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying.Foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain.[/vc_column_text][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Services Image and Title', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'].', '.$cat_display_names['services'];
$data['custom_class'] = 'block services';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/122.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_color="#f9f9f9" top_padding="70" bottom_padding="50"][vc_column width="1/5"][services_medium title="3-star Hotel" style="style_2" icon_bool="image" circle_color="" image="177"][/services_medium][/vc_column][vc_column width="1/5"][services_medium title="Double bedrooms" style="style_2" icon_bool="image" circle_color="" image="181"][/services_medium][/vc_column][vc_column width="1/5"][services_medium title="In-Room Service" style="style_2" icon_bool="image" circle_color="" image="185"][/services_medium][/vc_column][vc_column width="1/5"][services_medium title="No Smoking Rooms" style="style_2" icon_bool="image" circle_color="" image="189"][/services_medium][/vc_column][vc_column width="1/5"][services_medium title="Free Wireless" style="style_2" icon_bool="image" circle_color="" image="193"][/services_medium][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Booking Block', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'];
$data['custom_class'] = 'block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/121.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/2" css=".vc_custom_1552320244878{padding-top: 25px !important;padding-right: 30px !important;}"][vc_custom_heading text="AVAILABLE ROOMS" font_container="tag:h2|font_size:16px|text_align:left|color:%231c1c1c|line_height:24px" google_fonts="font_family:Roboto%3A100%2C100italic%2C300%2C300italic%2Cregular%2Citalic%2C500%2C500italic%2C700%2C700italic%2C900%2C900italic|font_style:300%20light%20regular%3A300%3Anormal" letter_space="6px" css=".vc_custom_1552319083832{margin-bottom: 0px !important;}"][vc_custom_heading text="Standard Room" font_container="tag:h2|font_size:36px|text_align:left|color:%231c1c1c|line_height:48px" use_theme_fonts="yes"][separator width="60px" height="1px" color="#c1a24d" margin_bottom="35px"][vc_column_text]On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying.

Foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain.[/vc_column_text][list icon="moon-arrow-right-3"][list_item title="Spa Service for Free"][list_item title="Breakfast Included"][list_item title="1 Double Bed &amp; 1 Single Bed"][/list][/vc_column][vc_column width="1/2" css=".vc_custom_1552322262916{padding-top: 35px !important;padding-right: 30px !important;padding-bottom: 25px !important;padding-left: 30px !important;background-color: #f9f9f9 !important;}"][vc_custom_heading text="RESERVER A ROOM" font_container="tag:h2|font_size:16px|text_align:left|color:%231c1c1c|line_height:24px" google_fonts="font_family:Roboto%3A100%2C100italic%2C300%2C300italic%2Cregular%2Citalic%2C500%2C500italic%2C700%2C700italic%2C900%2C900italic|font_style:300%20light%20regular%3A300%3Anormal" letter_space="6px" css=".vc_custom_1552322328873{margin-bottom: 0px !important;}"][vc_custom_heading text="Book with Specular" font_container="tag:h2|font_size:36px|text_align:left|color:%231c1c1c|line_height:48px" use_theme_fonts="yes"][separator width="60px" height="1px" color="#c1a24d" margin_bottom="35px"][contact-form-7 id="4"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Block with Toggles and Image', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'].', '.$cat_display_names['toggles'];
$data['custom_class'] = 'block toggles';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/120.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/2"][block_title style="column_title" title="Hotel Information"][/block_title][vc_tta_accordion shape="square" active_section="1" no_fill="true"][vc_tta_section title="How spacious are the rooms and suites of Hotel?" tab_id="1552296545313-516f9888-550f"][vc_column_text css=".vc_custom_1552298453928{margin-bottom: 15px !important;}"]Dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti[/vc_column_text][vc_column_text]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.[/vc_column_text][/vc_tta_section][vc_tta_section title="Travelling with a baby. Are there special beds?" tab_id="1552296545336-09489a09-cbba"][vc_column_text]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.[/vc_column_text][/vc_tta_section][vc_tta_section title="Haven't decided yet! Could you hold a room for me?" tab_id="1552297474107-6cf81408-3774"][vc_column_text]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.[/vc_column_text][/vc_tta_section][vc_tta_section title="The nearest metro station to the Hotel?" tab_id="1552297496206-af08bb29-4dc9"][vc_column_text]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.[/vc_column_text][/vc_tta_section][/vc_tta_accordion][/vc_column][vc_column width="1/2"][block_title style="column_title" title="SPA Center"][/block_title][media animation="none" image="151"][vc_column_text css=".vc_custom_1552298476319{margin-bottom: 25px !important;}"]At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.[/vc_column_text][button title="Reserve Now" icon="steadysets-icon-type"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Block Hotel Rooms', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'].', '.$cat_display_names['services'];
$data['custom_class'] = 'block services';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/119.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_color="#f9f9f9" bottom_padding="0"][vc_column][vc_custom_heading text="AVAILABLE ROOMS" font_container="tag:h2|font_size:16px|text_align:center|color:%231c1c1c|line_height:24px" google_fonts="font_family:Roboto%3A100%2C100italic%2C300%2C300italic%2Cregular%2Citalic%2C500%2C500italic%2C700%2C700italic%2C900%2C900italic|font_style:300%20light%20regular%3A300%3Anormal" letter_space="6px" css=".vc_custom_1552071271329{margin-bottom: 0px !important;}"][vc_custom_heading text="Accomodations" font_container="tag:h2|font_size:36px|text_align:center|color:%231c1c1c|line_height:48px" use_theme_fonts="yes"][separator width="60px" height="1px" position="center" color="#c1a24d" margin_bottom="35px"][/vc_column][/vc_row][vc_row type="full_width_background" bg_color="#f9f9f9" top_padding="0"][vc_column width="1/3"][media animation="none" image="122"][vc_row_inner gap="30"][vc_column_inner css=".vc_custom_1552139359393{margin-top: -120px !important;padding-top: 30px !important;padding-right: 30px !important;padding-bottom: 30px !important;padding-left: 30px !important;background-color: #ffffff !important;}"][vc_custom_heading text="Standard" font_container="tag:h3|font_size:24px|text_align:left|line_height:32px" use_theme_fonts="yes" css=".vc_custom_1552139502962{margin-bottom: 0px !important;}"][vc_custom_heading text="from $35/night" font_container="tag:div|font_size:14px|text_align:left|color:%23999999|line_height:26px" use_theme_fonts="yes" css=".vc_custom_1552139072915{margin-top: 0px !important;margin-bottom: 15px !important;}"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][button title="View More" link="https://codeless.co/specular/hotel/?page_id=206" icon="steadysets-icon-type"][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="1/3"][media animation="none" image="131"][vc_row_inner gap="30"][vc_column_inner css=".vc_custom_1552139359393{margin-top: -120px !important;padding-top: 30px !important;padding-right: 30px !important;padding-bottom: 30px !important;padding-left: 30px !important;background-color: #ffffff !important;}"][vc_custom_heading text="Junior Suite" font_container="tag:h3|font_size:24px|text_align:left|line_height:32px" use_theme_fonts="yes" css=".vc_custom_1552139544089{margin-bottom: 0px !important;}"][vc_custom_heading text="from $69/night" font_container="tag:div|font_size:14px|text_align:left|color:%23999999|line_height:26px" use_theme_fonts="yes" css=".vc_custom_1552139557455{margin-top: 0px !important;margin-bottom: 15px !important;}"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][button title="View More" link="https://codeless.co/specular/hotel/?page_id=206" icon="steadysets-icon-type"][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="1/3"][media animation="none" image="127"][vc_row_inner gap="30"][vc_column_inner css=".vc_custom_1552139359393{margin-top: -120px !important;padding-top: 30px !important;padding-right: 30px !important;padding-bottom: 30px !important;padding-left: 30px !important;background-color: #ffffff !important;}"][vc_custom_heading text="Premium Suite" font_container="tag:h3|font_size:24px|text_align:left|line_height:32px" use_theme_fonts="yes" css=".vc_custom_1552139550990{margin-bottom: 0px !important;}"][vc_custom_heading text="from $89/night" font_container="tag:div|font_size:14px|text_align:left|color:%23999999|line_height:26px" use_theme_fonts="yes" css=".vc_custom_1552139564013{margin-top: 0px !important;margin-bottom: 15px !important;}"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][button title="View More" link="https://codeless.co/specular/hotel/?page_id=206" icon="steadysets-icon-type"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Block with List/Button/Image', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'];
$data['custom_class'] = 'block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/118.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/2"][vc_custom_heading text="WELCOME TO SPECULAR HOTEL" font_container="tag:h2|font_size:16px|text_align:left|color:%231c1c1c|line_height:24px" google_fonts="font_family:Roboto%3A100%2C100italic%2C300%2C300italic%2Cregular%2Citalic%2C500%2C500italic%2C700%2C700italic%2C900%2C900italic|font_style:300%20light%20regular%3A300%3Anormal" letter_space="6px" css=".vc_custom_1551986019565{margin-bottom: 0px !important;}"][vc_custom_heading text="A Luxury Experience" font_container="tag:h2|font_size:36px|text_align:left|color:%231c1c1c|line_height:48px" use_theme_fonts="yes"][separator width="60px" height="1px" color="#c1a24d" margin_bottom="35px"][vc_column_text css=".vc_custom_1552298640352{margin-bottom: 15px !important;}"]Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo aque ipsa quae ab illo inventore veritatis et quasi architecto.[/vc_column_text][list icon="steadysets-icon-star"][list_item title="Free Parking"][list_item title="Free Wireless"][list_item title="No smoking Rooms"][/list][vc_empty_space height="5px"][button title="Explore More" icon="steadysets-icon-type"][/vc_column][vc_column width="1/2"][media alignment="center" image="57" width="450"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Block with Toggles and List', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'].', '.$cat_display_names['toggles'];
$data['custom_class'] = 'block toggles';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/117.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/2"][vc_custom_heading text="Why Choose Us?" font_container="tag:h3|text_align:left" use_theme_fonts="yes"][vc_tta_accordion active_section="1"][vc_tta_section title="Law Consultancy" tab_id="1551810056277-23db2d01-92e6"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus necwerw ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_tta_section][vc_tta_section title="Strategic Planning" tab_id="1551810056295-396a38ff-50f9"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus necwerw ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_tta_section][vc_tta_section title="Financial Consulting" tab_id="1551810124441-d59e416f-73a4"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus necwerw ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_tta_section][vc_tta_section title="Audit &amp; Assurance" tab_id="1551810137893-f441df62-c8d1"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus necwerw ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_tta_section][/vc_tta_accordion][/vc_column][vc_column width="1/2"][vc_custom_heading text="Our Mission" font_container="tag:h3|text_align:left" use_theme_fonts="yes"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][list icon="moon-arrow-right-3"][list_item title="Design &amp; Creating Business Strategies"][list_item title="Law Consultacy Services Included"][list_item title="Design &amp; Creating Business Strategies"][list_item title="Software and Resource Management"][list_item title="Law Consultacy Services Included"][list_item title="Business Services at a glance"][/list][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Block with Image Gallery', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'];
$data['custom_class'] = 'block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/116.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column][vc_custom_heading text="company overview" use_theme_fonts="yes" css=".vc_custom_1551809408297{margin-bottom: 20px !important;}"][separator color="#fde328" margin_bottom="20px"][vc_column_text]It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).[/vc_column_text][vc_gallery type="image_grid" images="66,65,64,67,37,69,68"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Counters Block', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'].', '.$cat_display_names['counter'];
$data['custom_class'] = 'block counter';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/115.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_image="64" parallax_bg="true" overlay="true" overlay_color="rgba(0,44,94,0.8)" text_color="light"][vc_column][vc_custom_heading text="what we have done" font_container="tag:h2|text_align:left|color:%23fde328" use_theme_fonts="yes" css=".vc_custom_1551798548282{margin-bottom: 5px !important;}"][vc_custom_heading text="on the last year full of success" font_container="tag:h3|text_align:left|color:%23ffffff" use_theme_fonts="yes" css=".vc_custom_1551797890272{margin-bottom: 0px !important;}"][vc_row_inner css=".vc_custom_1551798748049{margin-top: 10px !important;padding-top: 40px !important;}"][vc_column_inner width="1/4"][counter text="Products Reviewed" icon="steadysets-icon-chart" style="left" number="40000"][/vc_column_inner][vc_column_inner width="1/4"][counter text="Audited Companies" icon="steadysets-icon-connection-75" style="left" number="68"][/vc_column_inner][vc_column_inner width="1/4"][counter text="Awards Winning" icon="steadysets-icon-star" style="left" number="147"][/vc_column_inner][vc_column_inner width="1/4"][counter text="Satisfied Customers" icon="steadysets-icon-heart" style="left" number="1349"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( '6 Services with Image Icon Block', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'].', '.$cat_display_names['services'];
$data['custom_class'] = 'block services';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/114.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column][vc_custom_heading text="OUR SERVICES" font_container="tag:h2|text_align:center|color:%23002c5e" use_theme_fonts="yes" css=".vc_custom_1551783366436{margin-bottom: 20px !important;}"][separator position="center" color="#fde328" margin_bottom="20px"][vc_column_text css=".vc_custom_1551783405148{padding-right: 10% !important;padding-left: 10% !important;}"]
<p style="text-align: center;">I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>
[/vc_column_text][vc_row_inner css=".vc_custom_1551785305991{margin-top: 50px !important;}"][vc_column_inner width="1/3"][media alignment="center" animation="none" image="21" width="100"][vc_custom_heading text="Law Consultancy" font_container="tag:h4|text_align:center|color:%23002c5e" use_theme_fonts="yes" css=".vc_custom_1551784531751{margin-bottom: 10px !important;}"][vc_column_text]
<p style="text-align: center;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus necwerw ullamcorper mattis, pulvinar dapibus leo.</p>
[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3" css=".vc_custom_1551785453704{padding-top: 13px !important;}"][media alignment="center" animation="none" image="20" width="100"][vc_custom_heading text="Strategic Planning" font_container="tag:h4|text_align:center|color:%23002c5e" use_theme_fonts="yes" css=".vc_custom_1551785099737{margin-bottom: 10px !important;}"][vc_column_text]
<p style="text-align: center;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus necwerw ullamcorper mattis, pulvinar dapibus leo.</p>
[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3" css=".vc_custom_1551785458874{padding-top: 6px !important;}"][media alignment="center" animation="none" image="19" width="100"][vc_custom_heading text="Financial Consulting" font_container="tag:h4|text_align:center|color:%23002c5e" use_theme_fonts="yes" css=".vc_custom_1551785126905{margin-bottom: 10px !important;}"][vc_column_text]
<p style="text-align: center;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus necwerw ullamcorper mattis, pulvinar dapibus leo.</p>
[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_row_inner css=".vc_custom_1551785265282{margin-top: 50px !important;}"][vc_column_inner width="1/3"][media alignment="center" animation="none" image="18" width="100"][vc_custom_heading text="Audit &amp; Assurance" font_container="tag:h4|text_align:center|color:%23002c5e" use_theme_fonts="yes" css=".vc_custom_1551785156910{margin-bottom: 10px !important;}"][vc_column_text]
<p style="text-align: center;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus necwerw ullamcorper mattis, pulvinar dapibus leo.</p>
[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3"][media alignment="center" animation="none" image="17" width="100"][vc_custom_heading text="Business Services" font_container="tag:h4|text_align:center|color:%23002c5e" use_theme_fonts="yes" css=".vc_custom_1551785180318{margin-bottom: 10px !important;}"][vc_column_text]
<p style="text-align: center;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus necwerw ullamcorper mattis, pulvinar dapibus leo.</p>
[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3" css=".vc_custom_1551785573382{padding-top: 4px !important;}"][media alignment="center" animation="none" image="19" width="100"][vc_custom_heading text="Software &amp; Resource" font_container="tag:h4|text_align:center|color:%23002c5e" use_theme_fonts="yes" css=".vc_custom_1551785218893{margin-bottom: 10px !important;}"][vc_column_text]
<p style="text-align: center;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus necwerw ullamcorper mattis, pulvinar dapibus leo.</p>
[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Block Content with Image', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'];
$data['custom_class'] = 'block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/113.png' ); 
$data['content'] = <<<EOF
[vc_row top_padding="80"][vc_column width="1/2"][vc_custom_heading text="Our History of Search Engine Optimization" use_theme_fonts="yes" css=".vc_custom_1551374125436{margin-bottom: 20px !important;}"][vc_column_text][dropcaps form="square" color="#d3992d" fontcolor="#ffffff"]C[/dropcaps]ontrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure.

Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.[/vc_column_text][/vc_column][vc_column width="1/2"][media alignment="center" image="12" width="400"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Services Block with Image and white bg', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'].', '.$cat_display_names['services'];
$data['custom_class'] = 'block services';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/112.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_color="rgba(130,36,227,0.03)" top_padding="90" bottom_padding="90"][vc_column][vc_custom_heading text="See our top-notch services" font_container="tag:h2|text_align:center" use_theme_fonts="yes" css=".vc_custom_1551353708619{margin-bottom: 10px !important;}"][vc_custom_heading text="Sed ut perspiciatis unde omnis iste natus error sit voluptatem
accusantium doloremque laudantium" font_container="tag:p|text_align:center" use_theme_fonts="yes"][vc_row_inner][vc_column_inner width="1/4" css=".vc_custom_1551353510414{padding: 40px !important;background-color: #ffffff !important;border: 5px solid #fbf9fe !important;}"][media alignment="center" animation="none" image="58" width="200"][vc_custom_heading text="SEO Performance" font_container="tag:h4|text_align:center" use_theme_fonts="yes" css=".vc_custom_1551353753248{margin-bottom: 10px !important;}"][vc_column_text]
<p style="text-align: center;">Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur</p>
[/vc_column_text][/vc_column_inner][vc_column_inner width="1/4" css=".vc_custom_1551353517270{border-top-width: 5px !important;border-right-width: 5px !important;border-bottom-width: 5px !important;border-left-width: 5px !important;padding-top: 40px !important;padding-right: 40px !important;padding-bottom: 40px !important;padding-left: 40px !important;background-color: #ffffff !important;border-left-color: #fbf9fe !important;border-left-style: solid !important;border-right-color: #fbf9fe !important;border-right-style: solid !important;border-top-color: #fbf9fe !important;border-top-style: solid !important;border-bottom-color: #fbf9fe !important;border-bottom-style: solid !important;}"][media alignment="center" animation="none" image="59" width="200"][vc_custom_heading text="SEO Targeting" font_container="tag:h4|text_align:center" use_theme_fonts="yes" css=".vc_custom_1551353891302{margin-bottom: 10px !important;}"][vc_column_text]
<p style="text-align: center;">Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur</p>
[/vc_column_text][/vc_column_inner][vc_column_inner width="1/4" css=".vc_custom_1551353524575{border-top-width: 5px !important;border-right-width: 5px !important;border-bottom-width: 5px !important;border-left-width: 5px !important;padding-top: 40px !important;padding-right: 40px !important;padding-bottom: 40px !important;padding-left: 40px !important;background-color: #ffffff !important;border-left-color: #fbf9fe !important;border-left-style: solid !important;border-right-color: #fbf9fe !important;border-right-style: solid !important;border-top-color: #fbf9fe !important;border-top-style: solid !important;border-bottom-color: #fbf9fe !important;border-bottom-style: solid !important;}"][media alignment="center" animation="none" image="60" width="200"][vc_custom_heading text="SEO Monitoring" font_container="tag:h4|text_align:center" use_theme_fonts="yes" css=".vc_custom_1551353904506{margin-bottom: 10px !important;}"][vc_column_text]
<p style="text-align: center;">Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur</p>
[/vc_column_text][/vc_column_inner][vc_column_inner width="1/4" css=".vc_custom_1551353535227{border-top-width: 5px !important;border-right-width: 5px !important;border-bottom-width: 5px !important;border-left-width: 5px !important;padding-top: 40px !important;padding-right: 40px !important;padding-bottom: 40px !important;padding-left: 40px !important;background-color: #ffffff !important;border-left-color: #fbf9fe !important;border-left-style: solid !important;border-right-color: #fbf9fe !important;border-right-style: solid !important;border-top-color: #fbf9fe !important;border-top-style: solid !important;border-bottom-color: #fbf9fe !important;border-bottom-style: solid !important;}"][media alignment="center" animation="none" image="58" width="200"][vc_custom_heading text="Mobile SEO" font_container="tag:h4|text_align:center" use_theme_fonts="yes" css=".vc_custom_1551353922000{margin-bottom: 10px !important;}"][vc_column_text]
<p style="text-align: center;">Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur</p>
[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Block with Image and Text/List', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'];
$data['custom_class'] = 'block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/111.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_image="51" bg_position="right top"][vc_column width="1/2" css=".vc_custom_1551349069212{padding-right: 60px !important;padding-bottom: 40px !important;}"][vc_custom_heading text="Get tips &amp; tricks on how to boost your sales" use_theme_fonts="yes" css=".vc_custom_1551353946113{margin-bottom: 15px !important;}"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo. I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit.[/vc_column_text][list icon="steadysets-icon-star"][list_item title="Search Engine Optimization"][list_item title="Email Marketing Campaigns"][list_item title="Integration with Social Networks"][/list][/vc_column][vc_column width="1/2"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );



$data = array();
$data['name'] = esc_html__( 'Two Images and Text Columns', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'];
$data['custom_class'] = 'block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/109.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/3"][block_title style="column_title" inner_style="simple" padding_desc="28%" title="Our Kitchen"][separator width="40px" height="4px" position="left" color="#ef8717" margin_top="-15px" margin_bottom="20px"][vc_column_text]Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centurie.

But also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more [/vc_column_text][/vc_column][vc_column width="2/3"][media type="image" slideshow="posts" slideshow_post="1" slideshow_page="11" alignment="left" animation="left" image="47"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Two Images and Text Columns', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'];
$data['custom_class'] = 'block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/108.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/4"][media type="image" slideshow="posts" slideshow_post="1" slideshow_page="11" alignment="left" animation="left" image="33"][/vc_column][vc_column width="1/4"][media type="image" slideshow="posts" slideshow_post="1" slideshow_page="11" alignment="left" animation="left" image="32"][/vc_column][vc_column width="1/2"][block_title style="column_title" inner_style="simple" padding_desc="28%" title="Our Menu"][separator width="40px" height="4px" position="left" color="#ef8717" margin_top="-15px" margin_bottom="20px"][vc_column_text]Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centurie.

But also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.

Lorem Ipsum is not simply random text. It has roots in a piece of classical

<a href="//codeless.co/specular/restaurant/?page_id=52"><strong>View full menu</strong></a>[/vc_column_text][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Block Events and Recent News', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'].', '.$cat_display_names['blog'];
$data['custom_class'] = 'block blog';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/107.png' ); 
$data['content'] = <<<EOF
[vc_row type="in_container" bg_position="left top" bg_repeat="no-repeat" text_color="dark"][vc_column width="1/1"][vc_custom_heading text="CHURCH ACTIVITIES" font_container="tag:h2|font_size:28px|text_align:center|color:%23222222|line_height:32px" google_fonts="font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:600%20bold%20regular%3A600%3Anormal"][separator width="60px" height="2px" position="center" color="#222222" margin_top="-10px" margin_bottom="25px"][block_title style="section_title" padding_desc="5%" description="Lorem ipsum dolor sit amet, cu quo errem mollis laboramus. Et moderatius dissentiet sit, ne pri inani repudiandae, ea falli exerci soleat nec. Et vis modo legimus indoctum, eos an splendide definitiones. Etiam vocent eu vix, propriae "][vc_row_inner][vc_column_inner width="1/2"][block_title style="column_title" padding_desc="28%" title="Upcoming Events"][recent_news posts_per_page="3" dynamic_from_where="cat" dynamic_cat="3" style="events"][/vc_column_inner][vc_column_inner width="1/2"][block_title style="column_title" padding_desc="28%" title="Sermons"][recent_news posts_per_page="2" dynamic_from_where="cat" dynamic_cat="4" style="vertical"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Block with Services Media', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'].', '.$cat_display_names['services'];
$data['custom_class'] = 'block services';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/106.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" bg_color="#f6f6f6" text_color="dark"][vc_column width="1/1"][vc_custom_heading text="YOU NEED FAITH &amp; LOVE" font_container="tag:h2|font_size:28px|text_align:center|color:%23222222|line_height:32px" google_fonts="font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:600%20bold%20regular%3A600%3Anormal"][separator width="60px" height="2px" position="center" color="#222222" margin_top="-10px" margin_bottom="25px"][block_title style="section_title" padding_desc="5%" description="Lorem ipsum dolor sit amet, cu quo errem mollis laboramus. Et moderatius dissentiet sit, ne pri inani repudiandae, ea falli exerci soleat nec. Et vis modo legimus indoctum, eos an splendide definitiones. Etiam vocent eu vix, propriae "][vc_empty_space height="25px"][vc_row_inner][vc_column_inner width="1/3"][services_media title="Sermon Archhive" type="img" link="#" photo="779" style="style_2"][/vc_column_inner][vc_column_inner width="1/3"][services_media title="Study the bible " type="img" link="#" photo="780" style="style_2"][/vc_column_inner][vc_column_inner width="1/3"][services_media title="Nunc dolor sed" type="img" link="#" photo="781" style="style_2"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Services Circle with Image', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'].', '.$cat_display_names['services'];
$data['custom_class'] = 'block services';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/105.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/1"][vc_custom_heading text="WHO WE ARE" font_container="tag:h2|font_size:28px|text_align:center|color:%23222222|line_height:32px" google_fonts="font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:600%20bold%20regular%3A600%3Anormal"][separator width="60px" height="2px" position="center" color="#222222" margin_top="-10px" margin_bottom="25px"][block_title style="section_title" padding_desc="5%" description="Lorem ipsum dolor sit amet, cu quo errem mollis laboramus. Et moderatius dissentiet sit, ne pri inani repudiandae, ea falli exerci soleat nec. Et vis modo legimus indoctum, eos an splendide definitiones. Etiam vocent eu vix, propriae "][vc_empty_space height="40px"][vc_row_inner][vc_column_inner width="1/4"][services_medium title="Our Mission" style="style_1" icon_bool="image" icon="icon-glass" icon_color="#be3b3b" circle_color="#f5f5f5" border_color="#be3b3b" dynamic_content_type="content" dynamic_post="69" dynamic_page="15" dynamic_content_link="#" image="806"]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt[/services_medium][/vc_column_inner][vc_column_inner width="1/4"][services_medium title="Our Vision" style="style_1" icon_bool="image" icon="icon-glass" icon_color="#be3b3b" circle_color="#f5f5f5" border_color="#be3b3b" dynamic_content_type="content" dynamic_post="69" dynamic_page="15" dynamic_content_link="#" image="809"]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt[/services_medium][/vc_column_inner][vc_column_inner width="1/4"][services_medium title="History" style="style_1" icon_bool="image" icon="icon-glass" icon_color="#be3b3b" circle_color="#f5f5f5" border_color="#be3b3b" dynamic_content_type="content" dynamic_post="69" dynamic_page="15" dynamic_content_link="#" image="808"]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt[/services_medium][/vc_column_inner][vc_column_inner width="1/4"][services_medium title="For Kids" style="style_1" icon_bool="image" icon="icon-glass" icon_color="#be3b3b" circle_color="#f5f5f5" border_color="#be3b3b" dynamic_content_type="content" dynamic_post="69" dynamic_page="15" dynamic_content_link="#" image="807"]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt[/services_medium][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Contact Block', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'].', '.$cat_display_names['contact'];
$data['custom_class'] = 'block contact';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/104.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" bg_color="#f5f5f5" text_color="dark"][vc_column width="2/3"][contact-form-7 id="702"][/vc_column][vc_column width="1/3"][block_title style="column_title" padding_desc="28%" title="Publish your property"][separator width="40px" height="2px" position="left" color="#222222" margin_top="0px" margin_bottom="20px"][vc_column_text]Codeless has been quietly but consistently building a powerhouse portfolio of web site design and marketing.[/vc_column_text][list icon="linecon-icon-location"][list_item style="simple" title="228 Park Ave S
New York, NY 10003-1502"][/list][list icon="linecon-icon-phone"][list_item style="simple" title="+0114 5544 6687"][/list][list icon="linecon-icon-mail"][list_item style="simple" title="office@codeless.co
"][/list][list icon="linecon-icon-paperplane"][list_item style="simple" title="+100 55447 8877 (FAX)
"][/list][vc_column_text]

&amp;nbsp;

[h5_heading]You are welcome ![/h5_heading][/vc_column_text][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Block with Text and Social Icons', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'];
$data['custom_class'] = 'block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/103.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" bg_color="#222222" text_color="light"][vc_column width="1/2" animation="none" background_color_opacity="1" centered_cont="true" centered_cont_vertical="true" column_padding="4%"][media type="image" alignment="center" animation="left" image="145" width="200"][vc_widget_sidebar sidebar_id="sidebar-7"][/vc_column][vc_column width="1/2"][block_title style="column_title" inner_style="simple" padding_desc="28%" title="Contact us" second_title="Stay Connected"][separator width="40px" height="3px" position="left" color="#ffffff" margin_top="0px" margin_bottom="20px"][vc_column_text]
<p style="text-align: left;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially</p>
[/vc_column_text][button title="Contact Page" link="//codeless.co/specular/sliding/?page_id=123" icon="icon-glass" align="left"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Block With Button & Image', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'];
$data['custom_class'] = 'block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/102.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="repeat" parallax_bg="true" text_color="dark" top_padding="0" bottom_padding="0" bg_color="#ffffff"][vc_column width="1/2" animation="fadeInLeft" column_padding="3%" background_color_opacity="1" enable_animation="true" delay="0" css=".vc_custom_1415790078583{border-left-width: 3px !important;border-left-color: #d63e48 !important;border-left-style: solid !important;}"][block_title style="column_title" inner_style="simple" padding_desc="28%" title="Interior Design" second_title="Simple Hull Chair"][separator width="40px" height="3px" position="left" color="#222222" margin_top="0px" margin_bottom="20px"][vc_column_text]
<p style="text-align: left;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially</p>
<p style="text-align: left;">Unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions</p>
[/vc_column_text][button title="Learn More" link="//codeless.co/specular/sliding/?product=simple-hull-chair" icon="icon-glass" align="left"][/vc_column][vc_column width="1/2" animation="fadeInRight" background_color_opacity="1" enable_animation="true" delay="300"][media type="image" slideshow="posts" slideshow_post="1" slideshow_page="5" alignment="center" animation="left" image="196" width="400"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Contact Block Minimal', 'specular' );
$data['cat_display_name'] = $cat_display_names['contact'].', '.$cat_display_names['block'];
$data['custom_class'] = 'contact block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/101.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" text_color="dark"][vc_column width="1/1"][media type="image" slideshow="posts" slideshow_post="1" slideshow_page="148" alignment="left" animation="left" image="153"][/vc_column][/vc_row][vc_row][vc_column width="1/2"][block_title style="column_title" inner_style="simple" title="Contact Details"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer pharetra nulla ut nibh rhoncus hendrerit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam eget consectetur ligula. Fusce facilisis pulvinar sodales.

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer pharetra nulla ut nibh rhoncus hendrerit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam eget consectetur ligula. Fusce facilisis pulvinar sodales.

<strong>Address: </strong>Helicoidal Skyscraper, New York, NY 10004

<strong>Tel: </strong>+115554702

<strong>Email:</strong> info@specular.com[/vc_column_text][/vc_column][vc_column width="1/2"][block_title style="column_title" inner_style="simple" padding_desc="28%" title="Write to us"][contact-form-7 id="173"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Services only Text', 'specular' );
$data['cat_display_name'] = $cat_display_names['services'];
$data['custom_class'] = 'services';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/100.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" text_color="dark" bottom_padding="65"][vc_column width="1/3"][block_title style="column_title" inner_style="simple" padding_desc="28%" title="Our Story" inner_style_title="square"][vc_column_text]
<p style="text-align: center;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus et arcu massa. Aliquam tempus finibus lectus, ac viverra purus</p>
[/vc_column_text][/vc_column][vc_column width="1/3"][block_title style="column_title" inner_style="simple" padding_desc="28%" title="What we do" inner_style_title="square"][vc_column_text]
<p style="text-align: center;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus et arcu massa. Aliquam tempus finibus lectus, ac viverra purus</p>
[/vc_column_text][/vc_column][vc_column width="1/3"][block_title style="column_title" inner_style="simple" padding_desc="28%" title="Why Choose us" inner_style_title="square"][vc_column_text]
<p style="text-align: center;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus et arcu massa. Aliquam tempus finibus lectus, ac viverra purus</p>
[/vc_column_text][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Minimal Call To Action', 'specular' );
$data['cat_display_name'] = $cat_display_names['cta'];
$data['custom_class'] = 'cta';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/99.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" text_color="dark" top_padding="0"][vc_column width="1/1" css=".vc_custom_1414318315526{border-top-width: 1px !important;border-right-width: 1px !important;border-bottom-width: 1px !important;border-left-width: 1px !important;border-left-color: #e7e7e7 !important;border-right-color: #e7e7e7 !important;border-top-color: #e7e7e7 !important;border-bottom-color: #e7e7e7 !important;}" animation="none" column_padding="4%" background_color_opacity="1" background_color="#fcfcfc"][textbar title="Enjoy today new revolutionary experience" style="style_1" button_bool="yes" button_title="Purchase Now" button_link="#" icon="moon-arrow-right-5"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Block with Blog Recent', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'].', '.$cat_display_names['blog'];
$data['custom_class'] = 'block blog';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/98.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" text_color="dark" top_padding="0"][vc_column width="1/1"][separator width="100%" height="1px" position="left" color="#e7e7e7" margin_top="0px" margin_bottom="65px"][block_title style="section_title" inner_style="simple" padding_desc="12%" title="What's Next in 2015" description="Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock" inner_style_title="only_text"][vc_empty_space height="20px"][vc_row_inner][vc_column_inner width="1/2"][recent_news posts_per_page="2" dynamic_from_where="cat" dynamic_cat="1" style="vertical"][/vc_column_inner][vc_column_inner width="1/2"][recent_news posts_per_page="2" dynamic_from_where="cat" dynamic_cat="23" style="vertical"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Services with Image', 'specular' );
$data['cat_display_name'] = $cat_display_names['services'];
$data['custom_class'] = 'services';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/97.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" text_color="dark" bottom_padding="80" top_padding="80"][vc_column width="1/3"][services_media type="img" photo="19" style="style_1" link="#"][block_title style="column_title" inner_style="simple" padding_desc="28%" title="AUTUMN 2014"][/vc_column][vc_column width="1/3"][services_media type="img" photo="23" style="style_1" link="#"][block_title style="column_title" inner_style="simple" padding_desc="28%" title="NEXT RELEASES"][/vc_column][vc_column width="1/3"][services_media type="img" photo="22" style="style_1" link="#"][block_title style="column_title" inner_style="simple" padding_desc="28%" title="MINIMALIST SHOP"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'About Me Block', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'];
$data['custom_class'] = 'block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/96.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/1"][vc_column_text]
<p style="text-align: center;">[imagestyle style="circle"]//codeless.co/specular/minimal/wp-content/uploads/2014/09/team_1_square.png[/imagestyle]</p>
[/vc_column_text][vc_custom_heading text="About Me, Jake Duke" font_container="tag:h2|font_size:16px|text_align:center" google_fonts="font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:400%20regular%3A400%3Anormal"][block_title style="section_title" inner_style="simple" padding_desc="12%" description="On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Services Media', 'specular' );
$data['cat_display_name'] = $cat_display_names['services'];
$data['custom_class'] = 'services';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/95.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/3"][services_media title="View Latest Designs" type="img" photo="105" style="style_2" link="#"][/vc_column][vc_column width="1/3"][services_media title="New Artists" type="img" photo="97" style="style_2" link="#"][/vc_column][vc_column width="1/3"][services_media title="From Blog" type="img" photo="175" style="style_2" link="#"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Block Fullwidth with Services and Text', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'].', '.$cat_display_names['services'];
$data['custom_class'] = 'block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/94.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_content" bg_position="left top" bg_repeat="no-repeat" text_color="dark"][vc_column width="1/2" animation="fadeInLeft" centered_cont="true" background_color="#222222" background_color_opacity="1" column_padding="10%" font_color="#ffffff" delay="0"][vc_custom_heading text="OUR LOVELY SKILLS " font_container="tag:h2|font_size:24px|text_align:center|color:%23eab993|line_height:24px" google_fonts="font_family:Raleway%3A100%2C200%2C300%2Cregular%2C500%2C600%2C700%2C800%2C900|font_style:500%20bold%20regular%3A500%3Anormal"][vc_column_text]Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into.[/vc_column_text][/vc_column][vc_column width="1/4" animation="fadeIn" background_color="#f9f9f9" background_color_opacity="0.8" background_image="692" column_padding="5.7%" delay="200"][block_title style="column_title" padding_desc="28%" title="Illustration"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit.[/vc_column_text][block_title style="column_title" padding_desc="28%" title="Brand"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit.[/vc_column_text][/vc_column][vc_column width="1/4" animation="fadeIn" column_padding="5.7%" background_color="#f9f9f9" background_color_opacity="0.8" background_image="696" delay="400"][block_title style="column_title" padding_desc="28%" title="Web Design"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit.[/vc_column_text][block_title style="column_title" padding_desc="28%" title="Art Direction"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit.[/vc_column_text][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Block with Image', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'];
$data['custom_class'] = 'block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/93.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_content" bg_position="left top" bg_repeat="no-repeat" text_color="dark" bg_color="#ffffff"][vc_column width="1/2" animation="none" background_color_opacity="1" background_image="807"][/vc_column][vc_column width="1/2" animation="none" background_color="#ffffff" background_color_opacity="1" centered_cont="true" column_padding="10%"][vc_custom_heading text="SOMETHING ABOUT US" font_container="tag:h2|font_size:24px|text_align:center|color:%23eab993|line_height:24px" google_fonts="font_family:Raleway%3A100%2C200%2C300%2Cregular%2C500%2C600%2C700%2C800%2C900|font_style:500%20bold%20regular%3A500%3Anormal"][vc_column_text]Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.[/vc_column_text][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );


$data = array();
$data['name'] = esc_html__( 'Block with Image Box CTA', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'].', '.$cat_display_names['cta'];
$data['custom_class'] = 'block cta';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/92.png' ); 
$data['content'] = <<<EOF
[vc_row type="in_container" bg_position="left top" bg_repeat="no-repeat" text_color="dark"][vc_column width="2/3"][block_title style="column_title" padding_desc="28%" title="Welcome to our Hospital"][vc_column_text]Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into.

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into.

When an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into.[/vc_column_text][/vc_column][vc_column width="1/3" animation="none" background_color="rgba(245,245,245,0.85)" background_color_opacity="1" background_image="156" column_padding="4%"][block_title style="column_title" padding_desc="28%" title="Need Help ?"][vc_column_text]Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been[/vc_column_text][button title="Contact Now" link="#" icon="moon-play-4"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Services with Image', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'].', '.$cat_display_names['services'];
$data['custom_class'] = 'block services';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/91.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/4"][services_medium title="Ambulance Service" style="style_2" icon_bool="image" icon="moon-play-4" icon_color="#1e9ed6" circle_color="#f5f5f5" dynamic_content_type="content" dynamic_post="89" dynamic_page="115" dynamic_content_link="#" image="149"]<span style="color: #7b7d85;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy</span>[/services_medium][/vc_column][vc_column width="1/4"][services_medium title="Ambulance Service" style="style_2" icon_bool="image" icon="moon-play-4" icon_color="#1e9ed6" circle_color="#f5f5f5" dynamic_content_type="content" dynamic_post="89" dynamic_page="115" dynamic_content_link="#" image="148"]<span style="color: #7b7d85;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy</span>[/services_medium][/vc_column][vc_column width="1/4"][services_medium title="Ambulance Service" style="style_2" icon_bool="image" icon="moon-play-4" icon_color="#1e9ed6" circle_color="#f5f5f5" dynamic_content_type="content" dynamic_post="89" dynamic_page="115" dynamic_content_link="#" image="147"]<span style="color: #7b7d85;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy</span>[/services_medium][/vc_column][vc_column width="1/4"][services_medium title="Ambulance Service" style="style_2" icon_bool="image" icon="moon-play-4" icon_color="#1e9ed6" circle_color="#f5f5f5" dynamic_content_type="content" dynamic_post="89" dynamic_page="115" dynamic_content_link="#" image="146"]<span style="color: #7b7d85;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy</span>[/services_medium][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Services Small and Toggles', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'].', '.$cat_display_names['services'];
$data['custom_class'] = 'block services';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/90.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" bg_color="#f2f7f9" text_color="dark"][vc_column width="1/4"][block_title style="column_title" padding_desc="28%" title="Opening Hours"][separator width="0px" height="0px" position="center" color="#e1e1e1" margin_top="0px" margin_bottom="20px"][list icon="moon-clock"][list_item style="titledesc" title="Monday - Friday" desc="08:00 - 18:00"][list_item style="titledesc" title="Saturday" desc="08:00 - 14:00"][list_item style="titledesc" title="Sunday" desc="08:00 - 12:00"][/list][/vc_column][vc_column width="1/2"][block_title style="column_title" padding_desc="28%" title="Departments"][separator width="0px" height="0px" position="center" color="#e1e1e1" margin_top="0px" margin_bottom="20px"][vc_row_inner][vc_column_inner width="1/2"][services_small icon_bool="yes" icon="steadysets-icon-support" style="style_1" color_icon_wr="#222222" icon_color="#1e9ed6" dynamic_content_type="content" dynamic_post="1" dynamic_page="4" dynamic_content_link="#" dynamic_content_content="Lorem Ipsum is simply dummy text of the" title="Dental Clinic"][services_small icon_bool="yes" icon="icon-ambulance" style="style_1" color_icon_wr="#222222" icon_color="#1e9ed6" dynamic_content_type="content" dynamic_post="1" dynamic_page="4" dynamic_content_link="#" dynamic_content_content="Lorem Ipsum is simply dummy text of the" title="Diabetes Help Center"][/vc_column_inner][vc_column_inner width="1/2"][services_small icon_bool="yes" icon="moon-bubbles" style="style_1" color_icon_wr="#222222" icon_color="#1e9ed6" dynamic_content_type="content" dynamic_post="1" dynamic_page="4" dynamic_content_link="#" dynamic_content_content="Lorem Ipsum is simply dummy text of the" title="Gynacelogy"][services_small icon_bool="yes" icon="icon-phone" style="style_1" color_icon_wr="#222222" icon_color="#1e9ed6" dynamic_content_type="content" dynamic_post="1" dynamic_page="4" dynamic_content_link="#" dynamic_content_content="Lorem Ipsum is simply dummy text of the" title="Neurology"][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="1/4"][block_title style="column_title" padding_desc="28%" title="Why Choose Us ?"][separator width="0px" height="0px" position="center" color="#e1e1e1" margin_top="0px" margin_bottom="20px"][vc_accordion style="style_1"][vc_accordion_tab title="Ambulance Services" open="1"][vc_column_text]Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry[/vc_column_text][/vc_accordion_tab][vc_accordion_tab title="Great Infrastructure"][vc_column_text]Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry[/vc_column_text][/vc_accordion_tab][/vc_accordion][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Block with Image and List', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'];
$data['custom_class'] = 'block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/89.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/1"][vc_custom_heading text="Awesome demo for Health &amp; Medicine sites" font_container="tag:h2|font_size:36px|text_align:center|color:%23444444|line_height:36px" google_fonts="font_family:Lato%3A100%2C100italic%2C300%2C300italic%2Cregular%2Citalic%2C700%2C700italic%2C900%2C900italic|font_style:300%20light%20regular%3A300%3Anormal"][separator width="200px" height="1px" position="center" color="#e1e1e1" margin_top="0px" margin_bottom="40px"][vc_row_inner][vc_column_inner width="2/3"][media type="image" slideshow="posts" slideshow_post="1" slideshow_page="4" alignment="left" animation="left" image="27"][vc_column_text]Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown.Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown dummy text ever since the 1500s, when an unknown.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/3"][list icon="moon-arrow-right-5"][list_item style="titledesc" title="Psychiatry Services" desc="Lorem Ipsum is simply dummy text of the printing."][list_item style="titledesc" title="Insurance" desc="Lorem Ipsum is simply dummy text of the printing."][list_item style="titledesc" title="Medical Transportation" desc="Lorem Ipsum is simply dummy text of the printing."][list_item style="titledesc" title="Heart Services" desc="Lorem Ipsum is simply dummy text of the printing."][list_item style="titledesc" title="Palliative Care" desc="Lorem Ipsum is simply dummy text of the printing."][/list][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Services Colored Transparent', 'specular' );
$data['cat_display_name'] = $cat_display_names['services'].', '.$cat_display_names['block'];
$data['custom_class'] = 'services block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/88.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" text_color="light" transparency="1" bottom_padding="0"][vc_column width="1/3" animation="none" background_color_opacity="1" background_color="rgba(44,170,226,0.8)" font_color="#ffffff" column_padding="3%"][services_medium title="Healthcare Solutions" style="style_2" icon_bool="yes" icon="icon-ambulance" icon_color="#ffffff" dynamic_content_type="content" dynamic_post="1" dynamic_page="4" dynamic_content_link="#" circle_color="#f5f5f5"]Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC roots in a piece.[/services_medium][/vc_column][vc_column width="1/3" animation="none" background_color="rgba(30,158,214,0.8)" background_color_opacity="1" font_color="#ffffff" column_padding="3%"][services_medium title="Medical Kit" style="style_2" icon_bool="yes" icon="icon-medkit" icon_color="#ffffff" dynamic_content_type="content" dynamic_post="1" dynamic_page="4" dynamic_content_link="#" circle_color="#f5f5f5"]Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC roots in a piece.[/services_medium][/vc_column][vc_column width="1/3" animation="none" background_color="rgba(26,141,192,0.8)" background_color_opacity="1" font_color="#ffffff" column_padding="3%"][services_medium title="Healthcare Solutions" style="style_2" icon_bool="yes" icon="icon-hospital-o" icon_color="#ffffff" dynamic_content_type="content" dynamic_post="1" dynamic_page="4" dynamic_content_link="#" circle_color="#f5f5f5"]Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC roots in a piece.[/services_medium][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Contact Block', 'specular' );
$data['cat_display_name'] = $cat_display_names['contact'].', '.$cat_display_names['block'];
$data['custom_class'] = 'contact block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/87.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" text_color="dark" bottom_padding="80"][vc_column width="2/3"][vc_custom_heading text="Drop us a line" font_container="tag:h2|font_size:25px|text_align:left|line_height:16px" google_fonts="font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:400%20regular%3A400%3Anormal"][contact-form-7 id="30"][/vc_column][vc_column width="1/3"][vc_custom_heading text="Contact Details" font_container="tag:h2|font_size:25px|text_align:left|line_height:16px" google_fonts="font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:400%20regular%3A400%3Anormal"][vc_column_text]Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500

<strong>Address: </strong>75-81 Maiden Ln, New York, NY, USA

<strong>Tel:</strong> +102255777333

<strong>Email:</strong> info@specular.com[/vc_column_text][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Call To Action with Border', 'specular' );
$data['cat_display_name'] = $cat_display_names['cta'].', '.$cat_display_names['block'];
$data['custom_class'] = 'cta block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/86.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" text_color="dark" top_padding="20" bottom_padding="20"][vc_column width="1/1"][separator width="100%" height="1px" position="left" color="#e1e1e1" margin_top="0px" margin_bottom="40px"][textbar title="Is this the perfect clean and simple website your looking for ?" style="style_1" button_bool="yes" button_title="Purchase Now" button_link="//codeless.co/specular/join.php" icon="icon-glass"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Services Circle with Border', 'specular' );
$data['cat_display_name'] = $cat_display_names['services'].', '.$cat_display_names['block'];
$data['custom_class'] = 'services block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/85.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" text_color="dark" top_padding="60" bottom_padding="60"][vc_column width="1/1"][vc_custom_heading text="Specular is a Responsive Multi-Purpose Theme. We are specialized in web design for digital agencies and freelancers" font_container="tag:h2|font_size:32px|text_align:center|color:%23444444|line_height:48px" google_fonts="font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:300%20light%20regular%3A300%3Anormal"][separator width="100%" height="1px" position="left" color="#e1e1e1" margin_top="40px" margin_bottom="0px"][/vc_column][/vc_row][vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" text_color="dark" top_padding="20" bottom_padding="40"][vc_column width="1/3"][services_medium title="Responsive &amp; Retina" style="style_3" icon_bool="icon" icon="linecon-icon-eye" icon_color="#b4a28c" circle_color="#f5f5f5" border_color="#e5e5e5" dynamic_content_type="content" dynamic_post="87" dynamic_page="4" dynamic_content_link="#"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet[/services_medium][/vc_column][vc_column width="1/3"][services_medium title="Drag &amp; Drop" style="style_3" icon_bool="icon" icon="linecon-icon-stack" icon_color="#b4a28c" circle_color="#f5f5f5" border_color="#e5e5e5" dynamic_content_type="content" dynamic_post="87" dynamic_page="4" dynamic_content_link="#"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet[/services_medium][/vc_column][vc_column width="1/3"][services_medium title="Easy &amp; Powerful" style="style_3" icon_bool="icon" icon="linecon-icon-paperplane" icon_color="#b4a28c" circle_color="#f5f5f5" border_color="#e5e5e5" dynamic_content_type="content" dynamic_post="87" dynamic_page="4" dynamic_content_link="#"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet[/services_medium][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Price List and Counter', 'specular' );
$data['cat_display_name'] = $cat_display_names['counter'].', '.$cat_display_names['price'];
$data['custom_class'] = 'counter price';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/84.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" text_color="dark" class="sec5"][vc_column width="1/1"][vc_custom_heading text="Limit Offer - Get Instant Access" font_container="tag:h2|font_size:38px|text_align:center|color:%23222222|line_height:40px" google_fonts="font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:300%20light%20regular%3A300%3Anormal"][separator width="70px" height="2px" position="center" color="#0c93d6" margin_top="-15px" margin_bottom="20px"][countdown month="12" year="2019" day="28"][/vc_column][/vc_row][vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" text_color="dark" top_padding="0"][vc_column width="1/3"][price_list title="One Purpose" price="55" currency="$" period="month" bg_color="#f8f7f9" type="normal"][list_item style="simple" title="One Purpose"][list_item style="simple" title="Only one Layout"][list_item style="simple" title="Cant create custom layout"][list_item style="simple" title="Not curated sufficiently"][list_item style="simple" title="Need to buy a new after a month"][/price_list][/vc_column][vc_column width="1/3"][price_list title="Multi-Purpose" price="55" currency="$" period="Lifetime" bg_color="#f8f7f9" type="highlighted"][list_item style="simple" title="Awesome for multi-purpose"][list_item style="simple" title="Simple to install dummy data"][list_item style="simple" title="Infinite Layout Combinations"][list_item style="simple" title="Lifetime Free Support"][list_item style="simple" title="The last theme you have to buy"][/price_list][/vc_column][vc_column width="1/3"][price_list title="One Purpose" price="55" currency="$" period="month" bg_color="#f8f7f9" type="normal"][list_item style="simple" title="One Purpose"][list_item style="simple" title="Only one Layout"][list_item style="simple" title="Cant create custom layout"][list_item style="simple" title="Not curated sufficiently"][list_item style="simple" title="Need to buy a new after a month"][/price_list][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Image and Services Small', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'].', '.$cat_display_names['services'];
$data['custom_class'] = 'block services';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/83.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" bg_color="#f8f7f9" text_color="dark" class="sec2"][vc_column width="1/3"][media type="image" slideshow="posts" slideshow_post="1" slideshow_page="4" alignment="center" animation="left" image="83" width="300"][/vc_column][vc_column width="2/3"][vc_custom_heading text="Members Plethora of Features" font_container="tag:h2|font_size:38px|text_align:left|color:%23222222|line_height:40px" google_fonts="font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:300%20light%20regular%3A300%3Anormal"][separator width="70px" height="2px" position="left" color="#0c93d6" margin_top="-15px" margin_bottom="30px"][vc_row_inner][vc_column_inner width="1/2"][services_small title="Get free Consultation " icon_bool="yes" icon="linecon-icon-user" style="style_2" color_icon_wr="#0c93d6" icon_color="#ffffff" dynamic_content_type="content" dynamic_post="1" dynamic_page="4" dynamic_content_link="#" dynamic_content_content="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore."][services_small title="Vote for new Features" icon_bool="yes" icon="linecon-icon-like" style="style_2" color_icon_wr="#0c93d6" icon_color="#ffffff" dynamic_content_type="content" dynamic_post="1" dynamic_page="4" dynamic_content_link="#" dynamic_content_content="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore."][services_small title="Dedicated Support Team" icon_bool="yes" icon="linecon-icon-lab" style="style_2" color_icon_wr="#0c93d6" icon_color="#ffffff" dynamic_content_type="content" dynamic_post="1" dynamic_page="4" dynamic_content_link="#" dynamic_content_content="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore."][/vc_column_inner][vc_column_inner width="1/2"][services_small title="We love our customers " icon_bool="yes" icon="linecon-icon-heart" style="style_2" color_icon_wr="#0c93d6" icon_color="#ffffff" dynamic_content_type="content" dynamic_post="1" dynamic_page="4" dynamic_content_link="#" dynamic_content_content="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore."][services_small title="Weekly new Updates" icon_bool="yes" icon="linecon-icon-clock" style="style_2" color_icon_wr="#0c93d6" icon_color="#ffffff" dynamic_content_type="content" dynamic_post="1" dynamic_page="4" dynamic_content_link="#" dynamic_content_content="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore."][services_small title="It's Free LIFETIME" icon_bool="yes" icon="linecon-icon-bubble" style="style_2" color_icon_wr="#0c93d6" icon_color="#ffffff" dynamic_content_type="content" dynamic_post="1" dynamic_page="4" dynamic_content_link="#" dynamic_content_content="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore."][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Block List with Image', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'];
$data['custom_class'] = 'block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/82.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" bg_color="#f8f7f9" text_color="dark"][vc_column width="1/2"][vc_custom_heading text="The #1 Real Multi-Site" font_container="tag:h2|font_size:38px|text_align:left|color:%23222222|line_height:44px" google_fonts="font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:300%20light%20regular%3A300%3Anormal"][separator width="70px" height="2px" position="left" color="#0c93d6" margin_top="-15px" margin_bottom="20px"][vc_column_text]Not only home variations or demos but <strong>fully created sites</strong> for you ready to publish on the net.

More than 20+ ready to use sites created with <strong>research</strong> and <strong>dedication</strong>. Choose the right one and go online in <strong>5 minutes</strong>. Specular is the last theme you will ever need to buy. Keep coming back to this page to get the latest updates. <strong>New Features and Demo Sites added every week.</strong>[/vc_column_text][vc_row_inner][vc_column_inner width="1/2"][list icon="linecon-icon-star"][list_item style="simple" title="Main Demo"][list_item style="simple" title="Business"][list_item style="simple" title="Corporate"][list_item style="simple" title="Marketing"][list_item style="simple" title="Mobile App"][list_item style="simple" title="One Page"][/list][/vc_column_inner][vc_column_inner width="1/2"][list icon="linecon-icon-star"][list_item style="simple" title="Creative"][list_item style="simple" title="Church"][list_item style="simple" title="Medicine"][list_item style="simple" title="Real Estate"][list_item style="simple" title="Portfolio"][list_item style="simple" title="Photography"][/list][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="1/2"][media type="image" slideshow="posts" slideshow_post="1" slideshow_page="4" alignment="center" animation="left" image="81" width="300"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Block with Services Circle Color', 'specular' );
$data['cat_display_name'] = $cat_display_names['services'].', '.$cat_display_names['block'];
$data['custom_class'] = 'services block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/81.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" parallax_bg="" bg_color="#f6f6f6" overlay="" video_bg="" text_color="dark" top_padding="75" transparency="" borders=""][vc_column width="1/4"][services_medium title="1. Planning" style="style_1" icon_bool="icon" icon="linecon-icon-paperplane" icon_color="#ffffff" circle_color="#e2a34a" border_color="#e2a34a" dynamic_content_type="content" dynamic_post="83" dynamic_page="116" dynamic_content_link="#"]Phasellus enim libero, blandit vel sapien vitae, condimentum ultricies magna estasente et[/services_medium][/vc_column][vc_column width="1/4"][services_medium title="2. Design" style="style_1" icon_bool="icon" icon="steadysets-icon-phone-portrait" icon_color="#ffffff" circle_color="#e2a34a" border_color="#e2a34a" dynamic_content_type="content" dynamic_post="83" dynamic_page="116" dynamic_content_link="#"]Phasellus enim libero, blandit vel sapien vitae, condimentum ultricies magna estasente et[/services_medium][/vc_column][vc_column width="1/4"][services_medium title="3. Development" style="style_1" icon_bool="icon" icon="steadysets-icon-diamond" icon_color="#ffffff" circle_color="#e2a34a" border_color="#e2a34a" dynamic_content_type="content" dynamic_post="83" dynamic_page="116" dynamic_content_link="#"]Phasellus enim libero, blandit vel sapien vitae, condimentum ultricies magna estasente et[/services_medium][/vc_column][vc_column width="1/4"][services_medium title="4. Marketing" style="style_1" icon_bool="icon" icon="steadysets-icon-graph" icon_color="#ffffff" circle_color="#e2a34a" border_color="#e2a34a" dynamic_content_type="content" dynamic_post="83" dynamic_page="116" dynamic_content_link="#"]Phasellus enim libero, blandit vel sapien vitae, condimentum ultricies magna estasente et[/services_medium][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Blog Masonry', 'specular' );
$data['cat_display_name'] = $cat_display_names['blog'].', '.$cat_display_names['block'];
$data['custom_class'] = 'blog block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/80.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" parallax_bg="" bg_color="#f6f6f6" overlay="" video_bg="" text_color="dark" transparency="" borders=""][vc_column width="1/1" enable_animation="true" animation="fadeIn" delay="200" centered_cont="" centered_cont_vertical="" background_color_opacity="1"][block_title style="section_title" inner_style="simple" inner_style_title="only_text" padding_desc="24%" title="What's new in our blog" description="Phasellus enim libero, blandit vel sapien vitae, condimentum ultricies magna estasente et. Quisque euismod orci ut et lobortis aliquam."]Phasellus enim libero, [highlights] vel sapien vitae,[/highlights] condimentum ultricies magna estasente et.
Quisque euismod orci ut et lobortis aliquam.[/block_title][home_blog style="grid" posts_per_page="6" dynamic_from_where="all_cat" dynamic_cat="1"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Block with Image and Services Small', 'specular' );
$data['cat_display_name'] = $cat_display_names['services'].', '.$cat_display_names['block'];
$data['custom_class'] = 'services block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/79.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="center center" bg_repeat="no-repeat" parallax_bg="true" bg_color="#f6f6f6" overlay="true" video_bg="" text_color="dark" transparency="" borders="" bg_image="62" overlay_color="rgba(246,246,246,0.9)"][vc_column width="1/1"][block_title style="section_title" inner_style="simple" inner_style_title="only_text" padding_desc="24%" title="One of the most richest theme with features" description="Phasellus enim libero, blandit vel sapien vitae, condimentum ultricies magna estasente et. Quisque euismod orci ut et lobortis aliquam."]Phasellus enim libero, [highlights] vel sapien vitae,[/highlights] condimentum ultricies magna estasente et.
Quisque euismod orci ut et lobortis aliquam.[/block_title][vc_row_inner][vc_column_inner width="1/3" enable_animation="true" animation="fadeInLeft" centered_cont="" centered_cont_vertical="" background_color_opacity="1"][vc_empty_space height="95px"][services_small icon_bool="yes" icon="steadysets-icon-phone-portrait" style="style_2" color_icon_wr="#e2a34a" icon_color="#ffffff" dynamic_content_type="content" dynamic_post="1" dynamic_page="8" dynamic_content_link="#" title="Fully Responsive" align="right"]Phasellus enim libero, vel sapien vitae, condimentum ultricies magna estasente et enim libero, vel sapien vitae ultricies[/services_small][services_small icon_bool="yes" icon="linecon-icon-video" style="style_2" color_icon_wr="#e2a34a" icon_color="#ffffff" dynamic_content_type="content" dynamic_post="97" dynamic_page="8" dynamic_content_link="#" title="Video Background" align="right"]Phasellus enim libero, vel sapien vitae, condimentum ultricies magna estasente et enim libero, vel sapien vitae ultricies[/services_small][services_small icon_bool="yes" icon="steadysets-icon-book2" style="style_2" color_icon_wr="#e2a34a" icon_color="#ffffff" dynamic_content_type="content" dynamic_post="97" dynamic_page="8" dynamic_content_link="#" title="Custom Slider" align="right"]Phasellus enim libero, vel sapien vitae, condimentum ultricies magna estasente et enim libero, vel sapien vitae ultricies[/services_small][/vc_column_inner][vc_column_inner width="1/3" enable_animation="true" animation="fadeInUp" delay="0" centered_cont="" centered_cont_vertical="" background_color_opacity="1"][media type="image" alignment="center" animation="left" image="824" width="280"][/vc_column_inner][vc_column_inner width="1/3" enable_animation="true" animation="fadeInRight" delay="400" centered_cont="" centered_cont_vertical="" background_color_opacity="1"][vc_empty_space height="95px"][services_small icon_bool="yes" icon="moon-shuffle" style="style_2" color_icon_wr="#e2a34a" icon_color="#ffffff" dynamic_content_type="content" dynamic_post="97" dynamic_page="8" dynamic_content_link="#" title="Super Flexible" align="left"]Phasellus enim libero, vel sapien vitae, condimentum ultricies magna estasente et enim libero, vel sapien vitae ultricies[/services_small][services_small icon_bool="yes" icon="steadysets-icon-newspaper" style="style_2" color_icon_wr="#e2a34a" icon_color="#ffffff" dynamic_content_type="content" dynamic_post="97" dynamic_page="8" dynamic_content_link="#" title="Awesome Doc." align="left"]Phasellus enim libero, vel sapien vitae, condimentum ultricies magna estasente et enim libero, vel sapien vitae ultricies[/services_small][services_small icon_bool="yes" icon="steadysets-icon-diamond" style="style_2" color_icon_wr="#e2a34a" icon_color="#ffffff" dynamic_content_type="content" dynamic_post="97" dynamic_page="8" dynamic_content_link="#" title="New Updates" align="left"]Phasellus enim libero, vel sapien vitae, condimentum ultricies magna estasente et enim libero, vel sapien vitae ultricies[/services_small][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'CTA Dark', 'specular' );
$data['cat_display_name'] = $cat_display_names['cta'];
$data['custom_class'] = 'cta';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/78.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="center center" bg_repeat="no-repeat" parallax_bg="true" overlay="true" video_bg="" text_color="light" top_padding="120" bottom_padding="120" transparency="" borders="" overlay_color="#222222" bg_image="819"][vc_column width="1/1" enable_animation="true" animation="fadeInDown" delay="200" centered_cont="" centered_cont_vertical="" background_color_opacity="1"][vc_custom_heading text="WELCOME TO THE ULTIMATE THEME" font_container="tag:h2|font_size:18px|text_align:center|color:%23e2a34a|line_height:16px" google_fonts="font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:700%20bold%20regular%3A700%3Anormal" css=".vc_custom_1421686318932{margin-bottom: 25px !important;}"][textbar title="Super Parallax Section With Call-to-Action Element" style="style_2" button_bool="yes" button_title="Purchase Now" button_link="#" icon="linecon-icon-like"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Block CTA with Arrow Top', 'specular' );
$data['cat_display_name'] = $cat_display_names['block']. ', '.$cat_display_names['cta'];
$data['custom_class'] = 'block cta';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/77.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" parallax_bg="" bg_color="#343434" overlay="" video_bg="" text_color="light" top_padding="35" bottom_padding="35" transparency="" borders="" arrow_bottom="" arrow_top="1"][vc_column width="1/1"][textbar title="Come on board and get extra features, like 5 star support and free updates" style="style_1" button_bool="yes" button_title="Purchase Now" button_link="//codeless.co/specular/join.php" icon="icon-glass"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Block Section with Arrow Bottom', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'];
$data['custom_class'] = 'block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/76.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" parallax_bg="" bg_color="#343434" overlay="" video_bg="" text_color="light" transparency="" borders="" arrow_bottom="1" arrow_top="" top_padding="40" bottom_padding="40"][vc_column width="1/1"][vc_custom_heading text="WE ARE JUST GETTING STARTED. ARE YOU READY ?" font_container="tag:h3|font_size:16px|text_align:center|color:%234e89c9|line_height:32px" google_fonts="font_family:Roboto%3A100%2C100italic%2C300%2C300italic%2Cregular%2Citalic%2C500%2C500italic%2C700%2C700italic%2C900%2C900italic|font_style:700%20bold%20regular%3A700%3Anormal"][block_title style="section_title" inner_style="simple" inner_style_title="only_text" padding_desc="20%" title="Incredible &amp; Powerful Unique Features"]Some of our core features that you should see.
Why you should love this theme? See below all our most important features[/block_title][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Block with Image', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'];
$data['custom_class'] = 'block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/74.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/2"][vc_custom_heading text="Endlessly Customizable, Simple &amp; Codeless" font_container="tag:h2|font_size:22px|text_align:center|color:%23454545|line_height:30px" google_fonts="font_family:Arvo%3Aregular%2Citalic%2C700%2C700italic|font_style:400%20regular%3A400%3Anormal"][vc_empty_space height="16px"][block_title style="section_title" inner_style="simple" inner_style_title="only_text" padding_desc="0%"]Specular offer a large amount of customizable options. No need of code and design skills. Manage all aspects with Live Previewer. All our templates are created with [highlights]online customizer[/highlights] in mind. You can create your personalized template with possibility to change a lot of options to fit your needs before you spend money on it. With online customizer you can create [highlights]more than 200+ layouts[/highlights]<strong> </strong>and unique styles like no other theme ever created.[/block_title][block_title style="section_title" inner_style="simple" inner_style_title="only_text" padding_desc="0%"]So [highlights]simple[/highlights] and so powerful demos install with Specular. Select one template and [highlights]fully install[/highlights] in seconds. The new innovative import/export option from Codeless is awesome. Now you can backup your content, install a new dummy and return the backup in the most simplest way.[/block_title][/vc_column][vc_column width="1/2"][media type="image" alignment="left" animation="left" image="84"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );


$data = array();
$data['name'] = esc_html__( 'Block with Image and 2 Buttons', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'];
$data['custom_class'] = 'block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/73.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" parallax_bg="" overlay="" video_bg="" text_color="dark" bottom_padding="0" transparency="" borders=""][vc_column width="1/1"][block_title style="section_title" inner_style="simple" inner_style_title="only_text" padding_desc="20%" title="Specular is the #1 theme of this kind on the market"]Choose from multiple unique design with [highlights]just 1-click[/highlights]. Create your layout and style it online before buy. The [highlights]first and only[/highlights] Business Multi-Layout Theme[/block_title][button title="All Features" link="#" icon="icon-step-forward" align="center" button_bool="yes" button_2_title="Experts Review" button_2_link="#"][media type="image" alignment="left" animation="bottom" image="49"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Chart Skills', 'specular' );
$data['cat_display_name'] = $cat_display_names['skills'];
$data['custom_class'] = 'skills';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/72.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/1"][block_title style="column_title" inner_style="simple" padding_desc="28%" second_title="Discover our Skills"][separator width="80px" height="1px" position="left" color="#e7e7e7" margin_top="-15px" margin_bottom="30px"][vc_row_inner][vc_column_inner width="1/4"][chart_skill percent="90" text="PHP" color="#efefef"][/vc_column_inner][vc_column_inner width="1/4"][chart_skill percent="85" text="Design" color="#efefef"][/vc_column_inner][vc_column_inner width="1/4"][chart_skill percent="95" text="Creativity" color="#efefef"][/vc_column_inner][vc_column_inner width="1/4"][chart_skill percent="93" text="Innovation" color="#efefef"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Block with Skills and Text', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'];
$data['custom_class'] = 'block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/71.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/1"][vc_custom_heading text="Welcome to Business &amp; Corporate version of Specular Theme
Not only home variations but fully created sites for you ready to publish" font_container="tag:h2|font_size:26px|text_align:left|color:%23222222|line_height:38px" google_fonts="font_family:Raleway%3A100%2C200%2C300%2Cregular%2C500%2C600%2C700%2C800%2C900|font_style:300%20light%20regular%3A300%3Anormal"][separator width="100%" height="1px" position="left" color="#e7e7e7" margin_top="20px" margin_bottom="0px"][/vc_column][/vc_row][vc_row][vc_column width="1/3"][block_title style="column_title" inner_style="simple" padding_desc="28%" second_title="Our Approach "][separator width="80px" height="1px" position="left" color="#e7e7e7" margin_top="-15px" margin_bottom="30px"][vc_column_text]Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release.[/vc_column_text][/vc_column][vc_column width="1/3"][block_title style="column_title" inner_style="simple" padding_desc="28%" second_title="Our Goals"][separator width="80px" height="1px" position="left" color="#e7e7e7" margin_top="-15px" margin_bottom="30px"][vc_column_text]Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release.[/vc_column_text][/vc_column][vc_column width="1/3"][block_title style="column_title" inner_style="simple" padding_desc="28%" second_title="What we do"][separator width="80px" height="1px" position="left" color="#e7e7e7" margin_top="-15px" margin_bottom="30px"][skills][skill title="Architecture" percentage="70"][skill title="Marketing" percentage="85"][skill title="Online Business" percentage="86"][/skills][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Counters Block', 'specular' );
$data['cat_display_name'] = $cat_display_names['counter']. ', '. $cat_display_names['block'];
$data['custom_class'] = 'counter block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/70.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/1"][block_title style="column_title" inner_style="simple" padding_desc="28%" second_title="Fun Facts"][separator width="120px" height="1px" position="left" color="#e7e7e7" margin_top="-15px" margin_bottom="30px"][vc_row_inner][vc_column_inner width="1/4"][counter text="Months of Work" icon="moon-clock-3" number="8"][/vc_column_inner][vc_column_inner width="1/4"][counter text="Full Sites" icon="steadysets-icon-graph" number="20"][/vc_column_inner][vc_column_inner width="1/4"][counter text="Different Headers" icon="steadysets-icon-cloud" number="20"][/vc_column_inner][vc_column_inner width="1/4"][counter text="Cups of Tea" icon="icon-coffee" number="140"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Blog without Image', 'specular' );
$data['cat_display_name'] = $cat_display_names['blog'];
$data['custom_class'] = 'blog';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/68.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/1"][block_title style="column_title" inner_style="simple" padding_desc="28%" second_title="Latest From Blog"][separator width="120px" height="1px" position="left" color="#e7e7e7" margin_top="-15px" margin_bottom="25px"][latest_blog dynamic_from_where="all_cat" post_selected="1" dynamic_cat="1" carousel="no"][/vc_column][/vc_row][vc_row][vc_column width="1/1"][block_title style="column_title" inner_style="simple" padding_desc="28%" second_title="Latest From Blog"][separator width="120px" height="1px" position="left" color="#e7e7e7" margin_top="-15px" margin_bottom="25px"][latest_blog dynamic_from_where="all_cat" post_selected="1" dynamic_cat="1" carousel="no"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Portfolio Grid', 'specular' );
$data['cat_display_name'] = $cat_display_names['portfolio']. ', '.$cat_display_names['grid'];
$data['custom_class'] = 'portfolio grid';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/67.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/1"][block_title style="column_title" inner_style="simple" padding_desc="28%" second_title="Latest Portfolio"][separator width="120px" height="1px" position="left" color="#e7e7e7" margin_top="-15px" margin_bottom="30px"][recent_portfolio style="overlayed" mode="grid" space="normal" columns="4" rows="1" carousel="no" from_where="all_cat" category="3"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Services Small', 'specular' );
$data['cat_display_name'] = $cat_display_names['services'];
$data['custom_class'] = 'services';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/66.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/3"][services_small title="Dedicated Support Team" icon_bool="yes" icon="moon-users-3" style="style_1" color_icon_wr="#222222" icon_color="#e7e7e7" dynamic_content_type="content" dynamic_post="1" dynamic_page="4" dynamic_content_link="#" dynamic_content_content="Sed ut perspiciatis unde omnis iste natus error sit voluptatem"][/vc_column][vc_column width="1/3"][services_small title="#1 Multi-Site Theme" icon_bool="yes" icon="icon-sitemap" style="style_1" color_icon_wr="#222222" icon_color="#e7e7e7" dynamic_content_type="content" dynamic_post="1" dynamic_page="4" dynamic_content_link="#" dynamic_content_content="Sed ut perspiciatis unde omnis iste natus error sit voluptatem"][/vc_column][vc_column width="1/3"][services_small title="Awesome Business Demos" icon_bool="yes" icon="steadysets-icon-star" style="style_1" color_icon_wr="#222222" icon_color="#e7e7e7" dynamic_content_type="content" dynamic_post="1" dynamic_page="4" dynamic_content_link="#" dynamic_content_content="Sed ut perspiciatis unde omnis iste natus error sit voluptatem"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Pricelist', 'specular' );
$data['cat_display_name'] = $cat_display_names['block']. ', '.$cat_display_names['price'];
$data['custom_class'] = 'block price';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/65.png' ); 
$data['content'] = <<<EOF
[vc_row type="in_container" bg_position="left top" bg_repeat="no-repeat" text_color="dark"][vc_column width="1/3"][price_list title="One Purpose" price="55" currency="$" period="month" bg_color="#f8f7f9" type="normal"][list_item style="simple" title="One Purpose"][list_item style="simple" title="Only one Layout"][list_item style="simple" title="Cant create custom layout"][list_item style="simple" title="Not curated sufficiently"][list_item style="simple" title="Need to buy a new after a month"][/price_list][/vc_column][vc_column width="1/3"][price_list title="Multi-Purpose" price="55" currency="$" period="Lifetime" bg_color="#f8f7f9" type="highlighted"][list_item style="simple" title="Awesome for multi-purpose"][list_item style="simple" title="Simple to install dummy data"][list_item style="simple" title="Infinite Layout Combinations"][list_item style="simple" title="Lifetime Free Support"][list_item style="simple" title="The last theme you have to buy"][/price_list][/vc_column][vc_column width="1/3"][price_list title="One Purpose" price="55" currency="$" period="month" bg_color="#f8f7f9" type="normal"][list_item style="simple" title="One Purpose"][list_item style="simple" title="Only one Layout"][list_item style="simple" title="Cant create custom layout"][list_item style="simple" title="Not curated sufficiently"][list_item style="simple" title="Need to buy a new after a month"][/price_list][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Image & Skills', 'specular' );
$data['cat_display_name'] = $cat_display_names['block']. ', '.$cat_display_names['skills'];
$data['custom_class'] = 'block skills';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/64.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/2"][slideshow image_size="port3_grayscale" slides="49,48"][/vc_column][vc_column width="1/2"][block_title style="column_title" inner_style="inline_border" inner_style_title="square" padding_desc="28%" title="More About Us"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][skills][skill title="Web Design" percentage="78"][skill title="Development" percentage="95"][skill title="Branding" percentage="85"][skill title="Logos" percentage="80"][/skills][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Recent news and Lists', 'specular' );
$data['cat_display_name'] = $cat_display_names['block']. ', '.$cat_display_names['blog'];
$data['custom_class'] = 'block blog';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/63.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/2"][block_title style="column_title" inner_style="inline_border" inner_style_title="square" padding_desc="28%" title="Why Choose Us?"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][vc_row_inner][vc_column_inner width="1/2"][list icon="steadysets-icon-checkmark"][list_item style="simple" title="Extended Documentation"][list_item style="simple" title="Simple &amp; Amazing"][list_item style="simple" title="User Friendly"][list_item style="simple" title="More than 25 demos"][/list][/vc_column_inner][vc_column_inner width="1/2"][list icon="steadysets-icon-checkmark"][list_item style="simple" title="Large Support Team"][list_item style="simple" title="#1 Online Template Builder"][list_item style="simple" title="Weekly Updates"][list_item style="simple" title="Free Suggestions"][/list][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="1/2"][block_title style="column_title" inner_style="inline_border" inner_style_title="square" padding_desc="28%" title="Recent News"][recent_news posts_per_page="2" dynamic_from_where="all_cat" dynamic_cat="1" style="vertical"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Services Only Icon', 'specular' );
$data['cat_display_name'] = $cat_display_names['services'];
$data['custom_class'] = 'services';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/62.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/4"][services_medium style="style_2" icon_bool="icon" icon="moon-screen-3" icon_color="#e1e1e1" circle_color="#f5f5f5" border_color="#0f8dcb" dynamic_content_type="content" dynamic_post="1" dynamic_page="17" dynamic_content_link="#" title="Responsive &amp; Retina"]Sed ut perspiciatis unde omnis iste natus error sit  accusantium doloremque laudantium[/services_medium][/vc_column][vc_column width="1/4"][services_medium style="style_2" icon_bool="icon" icon="steadysets-icon-chart" icon_color="#e1e1e1" circle_color="#f5f5f5" border_color="#0f8dcb" dynamic_content_type="content" dynamic_post="1" dynamic_page="17" dynamic_content_link="#" title="Simple &amp; Business"]Sed ut perspiciatis unde omnis iste natus error sit  accusantium doloremque laudantium[/services_medium][/vc_column][vc_column width="1/4"][services_medium style="style_2" icon_bool="icon" icon="moon-cart-checkout" icon_color="#e1e1e1" circle_color="#f5f5f5" border_color="#0f8dcb" dynamic_content_type="content" dynamic_post="1" dynamic_page="17" dynamic_content_link="#" title="Woocommerce Compatible"]Sed ut perspiciatis unde omnis iste natus error sit  accusantium doloremque laudantium[/services_medium][/vc_column][vc_column width="1/4"][services_medium style="style_2" icon_bool="icon" icon="steadysets-icon-settings" icon_color="#e1e1e1" circle_color="#f5f5f5" border_color="#0f8dcb" dynamic_content_type="content" dynamic_post="1" dynamic_page="17" dynamic_content_link="#" title="Easy Page Builder"]Sed ut perspiciatis unde omnis iste natus error sit  accusantium doloremque laudantium[/services_medium][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Services Circle Color', 'specular' );
$data['cat_display_name'] = $cat_display_names['services'];
$data['custom_class'] = 'services';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/61.png' ); 
$data['content'] = <<<EOF
[vc_row type="in_container" bg_position="left top" bg_repeat="no-repeat" bg_color="#ffffff" text_color="dark"][vc_column width="1/3"][services_medium title="Fully Responsive" style="style_1" icon_bool="icon" icon="linecon-icon-phone" icon_color="#ffffff" border_color="#bbbbbb" dynamic_content_type="content" dynamic_post="1" dynamic_page="8" dynamic_content_link="#" circle_color="#00c49d"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna[/services_medium][/vc_column][vc_column width="1/3"][services_medium title="Drag &amp; Drop" style="style_1" icon_bool="icon" icon="linecon-icon-eye" icon_color="#ffffff" dynamic_content_type="content" dynamic_post="1" dynamic_page="8" dynamic_content_link="#" circle_color="#00c49d"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna[/services_medium][/vc_column][vc_column width="1/3"][services_medium title="Live Customizer" style="style_1" icon_bool="icon" icon="linecon-icon-params" icon_color="#ffffff" dynamic_content_type="content" dynamic_post="1" dynamic_page="8" dynamic_content_link="#" circle_color="#00c49d"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna[/services_medium][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Price List Block', 'specular' );
$data['cat_display_name'] = $cat_display_names['price']. ', '.$cat_display_names['block'];
$data['custom_class'] = 'price block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/60.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/1"][vc_custom_heading text="Welcome to Business &amp; Corporate version of <strong>Specular Theme</strong>
Not only home variations but <strong>fully created sites</strong> for you ready to publish" font_container="tag:h2|font_size:28px|text_align:center|color:%23555555|line_height:40px" google_fonts="font_family:Roboto%3A100%2C100italic%2C300%2C300italic%2Cregular%2Citalic%2C500%2C500italic%2C700%2C700italic%2C900%2C900italic|font_style:300%20light%20regular%3A300%3Anormal"][separator width="100%" height="1px" position="left" color="#e1e1e1" margin_top="20px" margin_bottom="0px"][/vc_column][/vc_row][vc_row][vc_column width="1/3"][price_list price="55" currency="$" period="month" bg_color="#f6f6f6" type="normal" title="Basic Package"][list_item style="simple" title="Page Builder"][list_item style="simple" title="Advanced Theme Options"][list_item style="simple" title="Retina"][list_item style="simple" title="Fully Responsive"][list_item style="simple" title="Wordpress Customizer"][/price_list][/vc_column][vc_column width="1/3"][price_list price="99" currency="$" period="month" bg_color="#f6f6f6" type="highlighted" title="Members Area"][list_item style="simple" title="Page Builder"][list_item style="simple" title="Advanced Theme Options"][list_item style="simple" title="Retina"][list_item style="simple" title="Fully Responsive"][list_item style="simple" title="Wordpress Customizer"][/price_list][/vc_column][vc_column width="1/3"][price_list price="150" currency="$" period="month" bg_color="#f6f6f6" type="normal" title="Premium Package"][list_item style="simple" title="Page Builder"][list_item style="simple" title="Advanced Theme Options"][list_item style="simple" title="Retina"][list_item style="simple" title="Fully Responsive"][list_item style="simple" title="Wordpress Customizer"][/price_list][/vc_column][/vc_row][vc_row][vc_column width="1/1"][textbar title="Don't hesitate buy your last theme :)" style="style_2" button_bool="yes" button_title="Read More" button_link="#" icon="icon-star"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Call To Action Boxed', 'specular' );
$data['cat_display_name'] = $cat_display_names['cta']. ', '.$cat_display_names['block'];
$data['custom_class'] = 'cta block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/59.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/1" animation="none" background_color="#f6f6f6" background_color_opacity="1" column_padding="2.5%"][textbar title="One Theme, Endless Possibilities and much more is coming in the next updates." style="style_1" button_bool="yes" button_title="Purchase Now" button_link="//codeless.co/specular/join.php" icon="moon-play-4"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Services Small Block', 'specular' );
$data['cat_display_name'] = $cat_display_names['services']. ', '.$cat_display_names['block'];
$data['custom_class'] = 'services block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/58.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/1"][vc_custom_heading text="Welcome to <b>Business &amp; Corporate</b> version of Specular Theme
Not only home variations but <b>fully created sites</b> for you ready to publish" font_container="tag:h2|font_size:28px|text_align:center|color:%23555555|line_height:40px" google_fonts="font_family:Roboto%3A100%2C100italic%2C300%2C300italic%2Cregular%2Citalic%2C500%2C500italic%2C700%2C700italic%2C900%2C900italic|font_style:300%20light%20regular%3A300%3Anormal"][separator width="100%" height="1px" position="left" color="#e1e1e1" margin_top="20px" margin_bottom="px"][/vc_column][/vc_row][vc_row type="in_container" bg_position="left top" bg_repeat="no-repeat" text_color="dark"][vc_column width="1/3"][services_small title="Responsive &amp; Retina" icon_bool="yes" icon="steadysets-icon-tablet" style="style_1" color_icon_wr="#222222" icon_color="#eaa133" dynamic_content_type="content" dynamic_post="1" dynamic_page="6" dynamic_content_link="#" dynamic_content_content="Lorem ipsum dolor sit amet communitas erdum, lacus et vulputate, velit nulla commodo sem."][services_small title="Multimedia Slides" icon_bool="yes" icon="steadysets-icon-cloud" style="style_1" color_icon_wr="#222222" icon_color="#eaa133" dynamic_content_type="content" dynamic_post="1" dynamic_page="6" dynamic_content_link="#" dynamic_content_content="Lorem ipsum dolor sit amet communitas erdum, lacus et vulputate, velit nulla commodo sem."][/vc_column][vc_column width="1/3"][services_small title="Drag &amp; Drop" icon_bool="yes" icon="steadysets-icon-box" style="style_1" color_icon_wr="#eaa133" icon_color="#eaa133" dynamic_content_type="content" dynamic_post="1" dynamic_page="6" dynamic_content_link="#" dynamic_content_content="Lorem ipsum dolor sit amet communitas erdum, lacus et vulputate, velit nulla commodo sem."][services_small title="Extra Side Navigation" icon_bool="yes" icon="steadysets-icon-star" style="style_1" color_icon_wr="#222222" icon_color="#eaa133" dynamic_content_type="content" dynamic_post="1" dynamic_page="6" dynamic_content_link="#" dynamic_content_content="Lorem ipsum dolor sit amet communitas erdum, lacus et vulputate, velit nulla commodo sem."][/vc_column][vc_column width="1/3"][services_small title="Visual Customizer" icon_bool="yes" icon="steadysets-icon-pencil" style="style_1" color_icon_wr="#222222" icon_color="#eaa133" dynamic_content_type="content" dynamic_post="1" dynamic_page="6" dynamic_content_link="#" dynamic_content_content="Lorem ipsum dolor sit amet communitas erdum, lacus et vulputate, velit nulla commodo sem."][services_small title="Parallax Sections" icon_bool="yes" icon="steadysets-icon-cube" style="style_1" color_icon_wr="#222222" icon_color="#eaa133" dynamic_content_type="content" dynamic_post="1" dynamic_page="6" dynamic_content_link="#" dynamic_content_content="Lorem ipsum dolor sit amet communitas erdum, lacus et vulputate, velit nulla commodo sem."][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Team with Title Border', 'specular' );
$data['cat_display_name'] = $cat_display_names['team']. ', '.$cat_display_names['block'];
$data['custom_class'] = 'team block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/57.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/1"][block_title style="column_title" inner_style="inline_border" padding_desc="28%" title="Our Team"][vc_row_inner][vc_column_inner width="1/3"][staff staff="743" style="style_1"][/vc_column_inner][vc_column_inner width="1/3"][staff staff="748" style="style_1"][/vc_column_inner][vc_column_inner width="1/3"][staff staff="747" style="style_1"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Skills with Text Column', 'specular' );
$data['cat_display_name'] = $cat_display_names['skills']. ', '.$cat_display_names['block'];
$data['custom_class'] = 'skills block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/56.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/2"][block_title style="column_title" inner_style="inline_border" padding_desc="28%" title="Who we are"][vc_column_text]Not only home variations or demos but fully created sites for you ready to publish on the net. More than 20+ ready to use sites created with research and dedication. Choose the right one and go online in 5 minutes. Specular is the last theme you will ever need to buy. Keep coming back to this page to get the latest updates. New Features and Demo Sites added every week.

With a staff of 12 members, Codeless will provide the most powerful and real-time support you have ever tried. Our staff members are concentrating in helping our customers to solve and customize their sites. Five of them working everyday to ensure that Specular stays clean, with no bugs and up-to-date. The last and the most important: It's FREE Lifetime[/vc_column_text][/vc_column][vc_column width="1/2"][block_title style="column_title" inner_style="inline_border" padding_desc="28%" title="Our Skills"][skills][skill title="Web Development" percentage="70"][skill title="Web Design" percentage="80"][skill title="Logos" percentage="95"][skill title="Branding" percentage="75"][/skills][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Clients with Title Border', 'specular' );
$data['cat_display_name'] = $cat_display_names['clients']. ', '.$cat_display_names['block'];
$data['custom_class'] = 'clients block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/55.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" text_color="dark" bottom_padding="40" top_padding="0"][vc_column width="1/1"][block_title style="column_title" inner_style="inline_border" padding_desc="28%" title="Our Clients"][clients dark_light="dark" carousel="yes"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Toggles Recent News Testimonial', 'specular' );
$data['cat_display_name'] = $cat_display_names['toggles'].', '. $cat_display_names['blog'].', '. $cat_display_names['testimonial'];
$data['custom_class'] = 'toggles blog testimonial';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/54.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/3"][block_title style="column_title" padding_desc="28%" title="Why Choose Us ?" inner_style="inline_border"][vc_accordion style="style_3"][vc_accordion_tab title="Easy to use and publish" open="1"][vc_column_text]With more than ten years experience in web site building and marketing campaigns we are able and sure to provide our customers with the possibility to create the best seller product on the market.[/vc_column_text][/vc_accordion_tab][vc_accordion_tab title="Members Area Plethora of Extra Features"][vc_column_text]These are our three major logic separations on Specular. What this mean? This means Codeless. No more code skills needing to start up your business, to boost your online sales, to create your portfolio, church, medicine, creative, photography, travel, restaurant (and much more) [/vc_column_text][/vc_accordion_tab][vc_accordion_tab title="Marketing Make Money"][vc_column_text]With more than ten years experience in web site building and marketing campaigns we are able and sure to provide our customers with the possibility to create the best seller product on the market.[/vc_column_text][/vc_accordion_tab][/vc_accordion][/vc_column][vc_column width="1/3"][block_title style="column_title" padding_desc="28%" title="Recent News" inner_style="inline_border"][recent_news posts_per_page="2" dynamic_from_where="all_cat" dynamic_cat="1" style="vertical"][/vc_column][vc_column width="1/3"][block_title style="column_title" padding_desc="28%" title="Testimonials" inner_style="inline_border"][testimonial_cycle][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Services Circle Border Block', 'specular' );
$data['cat_display_name'] = $cat_display_names['services'].', '. $cat_display_names['block'];
$data['custom_class'] = 'services block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/53.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/1"][vc_custom_heading font_container="tag:h2|font_size:28px|text_align:center|color:%23555555|line_height:40px" google_fonts="font_family:Roboto%3A100%2C100italic%2C300%2C300italic%2Cregular%2Citalic%2C500%2C500italic%2C700%2C700italic%2C900%2C900italic|font_style:300%20light%20regular%3A300%3Anormal" text="Welcome to <b>Business &amp; Corporate</b> version of Specular Theme
Not only home variations but <b>fully created sites</b> for you ready to publish"][separator width="100%" height="1px" position="left" color="#e1e1e1" margin_top="20px" margin_bottom="0px"][/vc_column][/vc_row][vc_row][vc_column width="1/3"][services_medium title="Fully Responsive" style="style_3" icon_bool="icon" icon="steadysets-icon-screen" icon_color="#eaa133" border_color="#e1e1e1" dynamic_content_type="content" dynamic_post="19" dynamic_page="6" dynamic_content_link="#" circle_color="#f5f5f5"]Sed ut perspiciatis unde omnis [highlights]iste natus[/highlights] error sit voluptatem accusantium doloremque laudantium[/services_medium][/vc_column][vc_column width="1/3"][services_medium title="Dedicated Support Center" style="style_3" icon_bool="icon" icon="steadysets-icon-chat-2" icon_color="#eaa133" border_color="#e1e1e1" dynamic_content_type="content" dynamic_post="19" dynamic_page="6" dynamic_content_link="#" circle_color="#f5f5f5"]With a staff of [highlights]12 members[/highlights], Codeless will provide the most powerful and [highlights]real-time support[/highlights][/services_medium][/vc_column][vc_column width="1/3"][services_medium title="Layout Flexibility" style="style_3" icon_bool="icon" icon="steadysets-icon-paperclip" icon_color="#eaa133" border_color="#e1e1e1" dynamic_content_type="content" dynamic_post="19" dynamic_page="6" dynamic_content_link="#" circle_color="#f5f5f5"]Provides unlimited [highlights]layout customizations[/highlights]. With easy theme options you can create an [highlights]unique page[/highlights][/services_medium][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Block with Skills and Toggles', 'specular' );
$data['cat_display_name'] = $cat_display_names['skills'].', '. $cat_display_names['block'];
$data['custom_class'] = 'skills block toggles';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/52.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/3"][block_title padding_desc="28%" title="Welcome to Specular Bundle"][vc_column_text]
<p style="color: #777777;">Codeless has been quietly but consistently building a powerhouse portfolio of web site design and marketing success.</p>
<p style="color: #777777;">We have cheerfully and expertly designed, developed, strategized and implemented web marketing programs and wordpress sites for small and large medical clients, non-profit foundations, design agencies, real estate groups and small service clients. Praesent tincidunt molestie libero mollis porta.</p>
[/vc_column_text][/vc_column][vc_column width="1/3"][block_title padding_desc="28%" title="Expertise in"][skills][skill title="Web Development" percentage="60"][skill title="Design" percentage="75"][skill title="UX / Animation" percentage="75"][skill title="Marketing" percentage="95"][/skills][/vc_column][vc_column width="1/3"][block_title padding_desc="28%" title="Why Choose Us"][vc_accordion][vc_accordion_tab title="Live Customizer" open="1"][vc_column_text]Lorem ipsum dolor sit amet communitas erdum, lacus et vulputate, velit nulla [/vc_column_text][/vc_accordion_tab][vc_accordion_tab title="12 staff members"][vc_column_text]<span style="color: #8f9196;">Lorem ipsum dolor sit amet communitas erdum, lacus et vulputate, velit nulla commodo sem.</span>[/vc_column_text][/vc_accordion_tab][vc_accordion_tab title="Professional"][vc_column_text]<span style="color: #8f9196;">Lorem ipsum dolor sit amet communitas erdum, lacus et vulputate, velit nulla commodo sem.</span>[/vc_column_text][/vc_accordion_tab][/vc_accordion][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Block with Text and Tabs', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'].', '. $cat_display_names['tabs'];
$data['custom_class'] = 'tabs block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/51.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/4"][block_title style="column_title" padding_desc="28%" title="Core Features"][list icon="moon-star"][list_item style="simple" title="Responsive &amp; Retina Design"][list_item style="simple" title="Drag &amp; Drop Page Builder"][list_item style="simple" title="25+ Demos created for you"][list_item style="simple" title="Only $58, get a bundle"][list_item style="simple" title="12 staff members work hard"][/list][/vc_column][vc_column width="1/2"][block_title style="column_title" padding_desc="28%" title="Multi-Purpose"][vc_column_text]We have cheerfully and expertly designed, developed, strategized and implemented web marketing programs and wordpress sites for small and large medical clients, non-profit foundations, design agencies.

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker[/vc_column_text][/vc_column][vc_column width="1/4"][vc_tabs style="style_1" position="top"][vc_tab title="Web" tab_id="1408616313-2-86"][vc_column_text]It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.

It is a long established fact that a reader will be distracted by the readable.[/vc_column_text][/vc_tab][vc_tab title="Design" tab_id="1408616566596-2-9"][vc_column_text]Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.[/vc_column_text][/vc_tab][vc_tab title="Seo" tab_id="1408616647584-2-5"][/vc_tab][/vc_tabs][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Services and Toggles', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'].', '. $cat_display_names['services'];
$data['custom_class'] = 'services block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/50.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="2/3"][block_title style="column_title" inner_style="simple" padding_desc="28%" title="Services We Offer"][vc_row_inner][vc_column_inner width="1/3"][services_small title="Retina" icon_bool="yes" icon="linecon-icon-phone" style="style_1" color_icon_wr="#222222" icon_color="#3595d6" dynamic_content_type="content" dynamic_post="732" dynamic_page="691" dynamic_content_link="#" dynamic_content_content="Codeless has been quietly but consistently building a powerhouse"][services_small title="Seo Services" icon_bool="yes" icon="steadysets-icon-search" style="style_1" color_icon_wr="#222222" icon_color="#3595d6" dynamic_content_type="content" dynamic_post="732" dynamic_page="691" dynamic_content_link="#" dynamic_content_content="Codeless has been quietly but consistently building a powerhouse"][/vc_column_inner][vc_column_inner width="1/3"][services_small title="Page Builder" icon_bool="yes" icon="linecon-icon-paperplane" style="style_1" color_icon_wr="#222222" icon_color="#3595d6" dynamic_content_type="content" dynamic_post="732" dynamic_page="691" dynamic_content_link="#" dynamic_content_content="Codeless has been quietly but consistently building a powerhouse"][services_small title="Database Installation" icon_bool="yes" icon="moon-database-3" style="style_1" color_icon_wr="#222222" icon_color="#3595d6" dynamic_content_type="content" dynamic_post="732" dynamic_page="691" dynamic_content_link="#" dynamic_content_content="Codeless has been quietly but consistently building a powerhouse"][/vc_column_inner][vc_column_inner width="1/3"][services_small title="Theme Options" icon_bool="yes" icon="moon-tools" style="style_1" color_icon_wr="#222222" icon_color="#3595d6" dynamic_content_type="content" dynamic_post="732" dynamic_page="691" dynamic_content_link="#" dynamic_content_content="Codeless has been quietly but consistently building a powerhouse"][services_small title="Development" icon_bool="yes" icon="icon-code" style="style_1" color_icon_wr="#222222" icon_color="#3595d6" dynamic_content_type="content" dynamic_post="732" dynamic_page="691" dynamic_content_link="#" dynamic_content_content="Codeless has been quietly but consistently building a powerhouse"][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="1/3"][block_title style="column_title" inner_style="simple" padding_desc="28%" title="Why Choose Us"][vc_accordion style="style_1"][vc_accordion_tab][vc_column_text]<span style="color: #696969;">Codeless has been quietly but consistently building a powerhouse, codeless has been quietly but consistently building a powerhouse</span>[/vc_column_text][/vc_accordion_tab][vc_accordion_tab title="Certified Products"][vc_column_text]<span style="color: #696969;">Codeless has been quietly but consistently building a powerhouse, codeless has been quietly but consistently building a powerhouse</span>[/vc_column_text][/vc_accordion_tab][vc_accordion_tab title="Support 24/7 "][vc_column_text]<span style="color: #696969;">Codeless has been quietly but consistently building a powerhouse, codeless has been quietly but consistently building a powerhouse</span>[/vc_column_text][/vc_accordion_tab][/vc_accordion][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Block with Text, list & Image', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'];
$data['custom_class'] = 'block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/49.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" bg_color="#f6f6f6" text_color="dark"][vc_column width="1/1"][block_title style="section_title" inner_style="simple" padding_desc="20%" description="Get a 25+ themes with the price of one. Specular Theme-Bundle comes with awesome and very easy options and page builder to create unlimited web sites." title="Software Engineering Corporate Website Theme" inner_style_title="only_text"][separator width="40px" height="20px" position="left" margin_top="0px" margin_bottom="0px"][vc_row_inner][vc_column_inner width="2/3"][vc_gallery type="flexslider_fade" interval="3" images="852,712,811" onclick="link_image" custom_links_target="_self" img_size="715x321"][/vc_column_inner][vc_column_inner width="1/3"][block_title style="column_title" inner_style="simple" padding_desc="28%" title="Latest Project"][vc_column_text]Codeless has been quietly but consistently building a powerhouse portfolio of web site design and marketing success.[/vc_column_text][list icon="icon-check"][list_item style="simple" title="New app finished development"][list_item style="simple" title="Aqueras Website Finished"][list_item style="simple" title="Oracle New Db installed"][list_item style="simple" title="Android Interface Completed"][/list][separator width="40px" height="15px" position="left" margin_top="0px" margin_bottom="0px"][button title="Read More" link="#" icon="icon-heart"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Block with Text and List', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'];
$data['custom_class'] = 'block grid';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/48.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/2"][block_title style="column_title" inner_style="simple" padding_desc="28%" title="About Specular"][vc_column_text]Codeless has been quietly but consistently building a powerhouse portfolio of web site design and marketing success.

We have cheerfully and expertly designed, developed, strategized and implemented web marketing programs and wordpress sites for small and large medical clients, non-profit foundations, design agencies, real estate groups and small service clients. Praesent tincidunt molestie libero mollis porta. Praesent sit amet faucibus leo.

Codeless has been quietly but consistently building a powerhouse portfolio of web site design and marketing success.[/vc_column_text][button title="Read More" link="#" icon="icon-star"][/vc_column][vc_column width="1/2"][block_title style="column_title" inner_style="simple" padding_desc="28%" title="Why Choose Us"][list icon="moon-checkmark-circle"][list_item style="titledesc" title="30+ Portfolio Layouts" desc="Use Masonry, Grid, Fullwidth or Boxed Layout and all of them with 3 styles and 2-5 columns"][list_item style="titledesc" title="Dedicated Support Team" desc="We have created a dedicated team only for the support and updates. 4 members work every day to ensure you that everything works fine."][list_item style="titledesc" title="One Click Demo Data" desc="With only one click create your site with your preferred demo from our list of demos."][list_item style="titledesc" title="Woocommerce Compatible" desc="Create your online shop now is easy then ever. In few minutes you can create your online store."][/list][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Services Media Grid', 'specular' );
$data['cat_display_name'] = $cat_display_names['services']. ', '.$cat_display_names['grid'];
$data['custom_class'] = 'services grid';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/47.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/3" animation="none" centered_cont="true" background_color_opacity="1"][services_media title="Advanced Theme Options" type="img" link="#" photo="60"]Nulla facilisi congue eu urna to lorem gravida quis ornare vel, mattis sed eros. Unterdum, lacus et vulputate pellen tesque, sit amet comm iunitas[/services_media][services_media title="Woocommerce Compatible" type="img" link="#" photo="68"]Nulla facilisi congue eu urna to lorem gravida quis ornare vel, mattis sed eros. Unterdum, lacus et vulputate pellen tesque, sit amet comm iunitas[/services_media][/vc_column][vc_column width="1/3" animation="none" centered_cont="true" background_color_opacity="1"][services_media title="Cross Browser Compatible" type="img" link="#" photo="62"]Nulla facilisi congue eu urna to lorem gravida quis ornare vel, mattis sed eros. Unterdum, lacus et vulputate pellen tesque, sit amet comm iunitas[/services_media][services_media title="Drag &amp; Drop" type="img" link="#" photo="65"]Nulla facilisi congue eu urna to lorem gravida quis ornare vel, mattis sed eros. Unterdum, lacus et vulputate pellen tesque, sit amet comm iunitas[/services_media][/vc_column][vc_column width="1/3" animation="none" centered_cont="true" background_color_opacity="1"][services_media title="Live Customizer" type="img" link="#" photo="66"]Nulla facilisi congue eu urna to lorem gravida quis ornare vel, mattis sed eros. Unterdum, lacus et vulputate pellen tesque, sit amet comm iunitas[/services_media][services_media title="Unlimited Portfolio Possibilities" type="img" link="#" photo="70"]Nulla facilisi congue eu urna to lorem gravida quis ornare vel, mattis sed eros. Unterdum, lacus et vulputate pellen tesque, sit amet comm iunitas[/services_media][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Services Small and Image Block', 'specular' );
$data['cat_display_name'] = $cat_display_names['services']. ', '.$cat_display_names['block'];
$data['custom_class'] = 'services block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/46.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/2"][media type="image" slideshow="posts" slideshow_post="732" slideshow_page="691" alignment="center" animation="left" image="962" width="330"][/vc_column][vc_column width="1/2" animation="none" column_padding="3%" background_color_opacity="1"][services_small title="30+ Portfolio Layouts" icon_bool="yes" icon="steadysets-icon-cube" style="style_1" color_icon_wr="#222222" icon_color="#3595d6" dynamic_content_type="content" dynamic_post="732" dynamic_page="691" dynamic_content_link="#" dynamic_content_content="Use Masonry, Grid, Fullwidth or Boxed Layout and all of them with 3 styles and 2-5 columns"][services_small title="Dedicated Support Team" icon_bool="yes" icon="steadysets-icon-user2" style="style_1" color_icon_wr="#222222" icon_color="#3595d6" dynamic_content_type="content" dynamic_post="732" dynamic_page="691" dynamic_content_link="#" dynamic_content_content="We have created a dedicated team only for the support and updates. 4 members work every day to ensure you that everything works fine."][services_small title="One Click Demo Data" icon_bool="yes" icon="steadysets-icon-select" style="style_1" color_icon_wr="#222222" icon_color="#3595d6" dynamic_content_type="content" dynamic_post="732" dynamic_page="691" dynamic_content_link="#" dynamic_content_content="With only one click create your site with your preferred demo from our list of demos."][services_small title="Woocommerce Compatible" icon_bool="yes" icon="steadysets-icon-graph" style="style_1" color_icon_wr="#222222" icon_color="#3595d6" dynamic_content_type="content" dynamic_post="732" dynamic_page="691" dynamic_content_link="#" dynamic_content_content="Create your online shop now is easy then ever. In few minutes you can create your online store."][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Portfolio Grid Block', 'specular' );
$data['cat_display_name'] = $cat_display_names['portfolio']. ', '.$cat_display_names['grid']. ', '.$cat_display_names['block'];
$data['custom_class'] = 'portfolio block grid';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/45.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" bg_color="#f6f6f6" text_color="dark" borders="1"][vc_column width="1/1"][block_title style="section_title" inner_style="simple" padding_desc="20%" description="Get a 25+ themes with the price of one. Specular Theme-Bundle comes with awesome and very easy options and page builder to create unlimited web sites." title="Outstanding Showcasing Features" inner_style_title="only_text"][vc_empty_space height="15px"][recent_portfolio style="basic" mode="grid" space="normal" columns="4" rows="1" carousel="no" from_where="all_cat" category="3"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Services Small with Color', 'specular' );
$data['cat_display_name'] = $cat_display_names['services'];
$data['custom_class'] = 'services';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/44.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" text_color="dark" top_padding="65" bottom_padding="65"][vc_column width="1/3"][services_small title="Responsive &amp; Retina" icon_bool="yes" icon="steadysets-icon-tablet" style="style_2" color_icon_wr="#3595d6" icon_color="#ffffff" dynamic_content_type="content" dynamic_post="1" dynamic_page="6" dynamic_content_link="#" dynamic_content_content="Lorem ipsum dolor sit amet communitas erdum, lacus et vulputate, velit nulla commodo sem ipsum dolor sit amet."][/vc_column][vc_column width="1/3"][services_small title="Drag &amp; Drop" icon_bool="yes" icon="steadysets-icon-box" style="style_2" color_icon_wr="#3595d6" icon_color="#ffffff" dynamic_content_type="content" dynamic_post="1" dynamic_page="6" dynamic_content_link="#" dynamic_content_content="Lorem ipsum dolor sit amet communitas erdum, lacus et vulputate, velit nulla commodo sem ipsum dolor sit amet."][/vc_column][vc_column width="1/3"][services_small title="Visual Customizer" icon_bool="yes" icon="steadysets-icon-pencil" style="style_2" color_icon_wr="#3595d6" icon_color="#ffffff" dynamic_content_type="content" dynamic_post="1" dynamic_page="6" dynamic_content_link="#" dynamic_content_content="Lorem ipsum dolor sit amet communitas erdum, lacus et vulputate, velit nulla commodo sem ipsum dolor sit amet."][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Block Text and List', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'];
$data['custom_class'] = 'block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/43.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/3"][block_title style="column_title" inner_style="simple" padding_desc="28%" title="Our Mission"][vc_column_text]Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,[/vc_column_text][/vc_column][vc_column width="1/3"][block_title style="column_title" inner_style="simple" padding_desc="28%" title="Our Goal"][vc_column_text]Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,[/vc_column_text][/vc_column][vc_column width="1/3"][block_title style="column_title" inner_style="simple" padding_desc="28%" title="Experience"][list icon="steadysets-icon-star"][list_item style="simple" title="Ten years in web development"][list_item style="simple" title="Working hard is our priority"][list_item style="simple" title="Ensure you the best product"][list_item style="simple" title="Support &amp; Documentation"][/list][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Services Circle Block', 'specular' );
$data['cat_display_name'] = $cat_display_names['services']. ', '.$cat_display_names['block'];
$data['custom_class'] = 'services block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/42.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/1"][vc_custom_heading text="Create your online website with only 1-click" font_container="tag:h2|font_size:32px|text_align:center|color:%233a3a3a|line_height:38px" google_fonts="font_family:Raleway%3A100%2C200%2C300%2Cregular%2C500%2C600%2C700%2C800%2C900|font_style:700%20bold%20regular%3A700%3Anormal"][separator width="60px" height="2px" position="center" color="#222222" margin_top="-15px" margin_bottom="20px"][block_title style="section_title" inner_style="simple" padding_desc="12%" description="Not only home variations or demos but fully created sites for you ready to publish on the net.
More than 20+ ready to use sites created with research and dedication. Choose the right one and go online in 5 minutes."][separator width="100%" height="0px" position="center" color="#222222" margin_top="20px" margin_bottom="20px"][vc_row_inner][vc_column_inner width="1/4"][services_medium title="Fully Responsive" style="style_3" icon_bool="icon" icon="steadysets-icon-email2" icon_color="#b3b3b3" border_color="#b3b3b3" dynamic_content_type="content" dynamic_post="794" dynamic_page="8" dynamic_content_link="#" circle_color="#f5f5f5"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna[/services_medium][/vc_column_inner][vc_column_inner width="1/4"][services_medium title="Drag &amp; Drop" style="style_3" icon_bool="icon" icon="linecon-icon-eye" icon_color="#b3b3b3" border_color="#b3b3b3" dynamic_content_type="content" dynamic_post="794" dynamic_page="8" dynamic_content_link="#" circle_color="#f5f5f5"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna[/services_medium][/vc_column_inner][vc_column_inner width="1/4"][services_medium title="Live Customizer" style="style_3" icon_bool="icon" icon="linecon-icon-params" icon_color="#b3b3b3" border_color="#b3b3b3" dynamic_content_type="content" dynamic_post="794" dynamic_page="8" dynamic_content_link="#" circle_color="#f5f5f5"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna[/services_medium][/vc_column_inner][vc_column_inner width="1/4"][services_medium title="Easy Showcase" style="style_3" icon_bool="icon" icon="steadysets-icon-camera" icon_color="#b3b3b3" border_color="#b3b3b3" dynamic_content_type="content" dynamic_post="794" dynamic_page="8" dynamic_content_link="#" circle_color="#f5f5f5"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna[/services_medium][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Counters Fullwidth with Colors Block', 'specular' );
$data['cat_display_name'] = $cat_display_names['counter']. ', '.$cat_display_names['block'];
$data['custom_class'] = 'counter block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/41.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_content" bg_position="left top" bg_repeat="no-repeat" text_color="light"][vc_column width="1/4" animation="none" background_color="#e8b24e" background_color_opacity="1" column_padding="5%"][counter text="Visits received" icon="steadysets-icon-graph" number="87752"][/vc_column][vc_column width="1/4" animation="none" background_color="#ebbc65" background_color_opacity="1" column_padding="5%"][counter text="Followers" icon="steadysets-icon-chat-2" number="47750"][/vc_column][vc_column width="1/4" animation="none" background_color="#eec67c" background_color_opacity="1" column_padding="5%"][counter text="Lines of code" icon="steadysets-icon-crop" number="145778"][/vc_column][vc_column width="1/4" animation="none" background_color="#f1d092" background_color_opacity="1" column_padding="5%"][counter text="Active Users" icon="steadysets-icon-users" number="17800"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Call To Action', 'specular' );
$data['cat_display_name'] = $cat_display_names['cta'];
$data['custom_class'] = 'cta';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/40.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" bg_color="#f6f6f6" text_color="dark" top_padding="60" bottom_padding="52"][vc_column width="1/1"][textbar title="Unlimited ways of showcasing with Specular" style="style_2" button_bool="yes" button_title="Purchase Now" button_link="//codeless.co/specular/join.php" icon="icon-glass"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Portfolio Grid Block', 'specular' );
$data['cat_display_name'] = $cat_display_names['portfolio']. ', '.$cat_display_names['grid']. ', '.$cat_display_names['block'];
$data['custom_class'] = 'portfolio grid block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/39.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" bg_color="base" text_color="light" bottom_padding="45" top_padding="45"][vc_column width="1/1"][vc_custom_heading text="The perfect way to showcase your work" font_container="tag:h2|font_size:32px|text_align:center|color:%23ffffff|line_height:38px" google_fonts="font_family:Raleway%3A100%2C200%2C300%2Cregular%2C500%2C600%2C700%2C800%2C900|font_style:600%20bold%20regular%3A600%3Anormal"][/vc_column][/vc_row][vc_row type="full_width_content" bg_position="left top" bg_repeat="no-repeat" text_color="dark" bg_color="#f6f6f6"][vc_column width="1/1"][recent_portfolio style="grayscale" mode="grid" space="no_space" columns="4" rows="2" carousel="no" from_where="all_cat" category="6"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Services Circle White BG', 'specular' );
$data['cat_display_name'] = $cat_display_names['services'];
$data['custom_class'] = 'services';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/37.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" bg_color="#f6f6f6" text_color="dark"][vc_column width="1/4"][services_medium title="Fully Responsive" style="style_1" icon_bool="icon" icon="steadysets-icon-email2" icon_color="#e8b24e" border_color="#b3b3b3" dynamic_content_type="content" dynamic_post="794" dynamic_page="8" dynamic_content_link="#" circle_color="#ffffff"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna[/services_medium][/vc_column][vc_column width="1/4"][services_medium title="Drag &amp; Drop" style="style_1" icon_bool="icon" icon="linecon-icon-eye" icon_color="#e8b24e" border_color="#b3b3b3" dynamic_content_type="content" dynamic_post="794" dynamic_page="8" dynamic_content_link="#" circle_color="#ffffff"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna[/services_medium][/vc_column][vc_column width="1/4"][services_medium title="Live Customizer" style="style_1" icon_bool="icon" icon="linecon-icon-params" icon_color="#e8b24e" border_color="#b3b3b3" dynamic_content_type="content" dynamic_post="794" dynamic_page="8" dynamic_content_link="#" circle_color="#ffffff"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna[/services_medium][/vc_column][vc_column width="1/4"][services_medium title="Easy Showcase" style="style_1" icon_bool="icon" icon="steadysets-icon-camera" icon_color="#e8b24e" border_color="#b3b3b3" dynamic_content_type="content" dynamic_post="794" dynamic_page="8" dynamic_content_link="#" circle_color="#ffffff"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna[/services_medium][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Block with Image', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'];
$data['custom_class'] = 'block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/36.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/2"][vc_custom_heading text="Create your online website
with only 1-click" font_container="tag:h2|font_size:34px|text_align:left|color:%23222222|line_height:48px" google_fonts="font_family:Raleway%3A100%2C200%2C300%2Cregular%2C500%2C600%2C700%2C800%2C900|font_style:600%20bold%20regular%3A600%3Anormal"][separator width="60px" height="2px" position="left" color="#222222" margin_top="-7px" margin_bottom="30px"][vc_custom_heading text="Not only home variations or demos but fully created sites
for you ready to publish on the net. More than 20+ ready to use sites created with research and dedication. Choose the right one and go online in 5 minutes." font_container="tag:h2|font_size:16px|text_align:left|color:%23555555|line_height:30px" google_fonts="font_family:Raleway%3A100%2C200%2C300%2Cregular%2C500%2C600%2C700%2C800%2C900|font_style:400%20regular%3A400%3Anormal"][/vc_column][vc_column width="1/2"][media type="image" alignment="center" animation="left" image="881" width="350"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Contact Block 2', 'specular' );
$data['cat_display_name'] = $cat_display_names['contact'].', '.$cat_display_names['block'];
$data['custom_class'] = 'contact block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/35.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/3"][block_title style="column_title" padding_desc="28%" title="More Information" second_title="Our addresses, phones etc..."][vc_column_text]Codeless has been quietly but consistently building a powerhouse portfolio of web site design and marketing.[/vc_column_text][list icon="linecon-icon-location"][list_item style="simple" title="228 Park Ave S
New York, NY 10003-1502"][/list][list icon="linecon-icon-phone"][list_item style="simple" title="+0114 5544 6687"][/list][list icon="linecon-icon-mail"][list_item style="simple" title="office@codeless.co
"][/list][list icon="linecon-icon-paperplane"][list_item style="simple" title="+100 55447 8877 (FAX)
"][/list][vc_column_text]

&nbsp;

[h5_heading]You are welcome ![/h5_heading][/vc_column_text][/vc_column][vc_column width="2/3"][block_title style="column_title" padding_desc="28%" title="Get connected"][contact-form-7 id="1046"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Contact Block', 'specular' );
$data['cat_display_name'] = $cat_display_names['contact'].', '.$cat_display_names['block'];
$data['custom_class'] = 'contact block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/33.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="2/3"][block_title style="column_title" padding_desc="28%" title="Get connected"][contact-form-7 id="1046"][/vc_column][vc_column width="1/3"][block_title style="column_title" padding_desc="28%" title="More Information" second_title="Our addresses, phones etc..."][vc_column_text]Codeless has been quietly but consistently building a powerhouse portfolio of web site design and marketing.[/vc_column_text][list icon="linecon-icon-location"][list_item style="simple" title="228 Park Ave S
New York, NY 10003-1502"][/list][list icon="linecon-icon-phone"][list_item style="simple" title="+0114 5544 6687"][/list][list icon="linecon-icon-mail"][list_item style="simple" title="office@codeless.co
"][/list][list icon="linecon-icon-paperplane"][list_item style="simple" title="+100 55447 8877 (FAX)
"][/list][vc_column_text]

&nbsp;

[h5_heading]You are welcome ![/h5_heading][/vc_column_text][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'FAQ', 'specular' );
$data['cat_display_name'] = $cat_display_names['faq'];
$data['custom_class'] = 'faq';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/32.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/1"][faq style="style_2"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Services Circle with Border', 'specular' );
$data['cat_display_name'] = $cat_display_names['block']. ', '.$cat_display_names['services'];
$data['custom_class'] = 'block services';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/31.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" bg_color="#ffffff" text_color="dark"][vc_column width="1/4"][block_title title="Our Process" second_title="Success in 4 steps" style="column_title"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis,[/vc_column_text][/vc_column][vc_column width="3/4"][vc_row_inner][vc_column_inner width="1/4"][services_steps title="01. Planning" icon="steadysets-icon-graph"]Phasellus enim libero, blandit vel sapien vitae, ultricies.[/services_steps][/vc_column_inner][vc_column_inner width="1/4"][services_steps title="02. Design" icon="steadysets-icon-atom"]Phasellus enim libero, blandit vel sapien vitae, ultricies.[/services_steps][/vc_column_inner][vc_column_inner width="1/4"][services_steps title="03. Develop" icon="steadysets-icon-tablet"]Phasellus enim libero, blandit vel sapien vitae, ultricies.[/services_steps][/vc_column_inner][vc_column_inner width="1/4"][services_steps title="04. Support" icon="steadysets-icon-support"]Phasellus enim libero, blandit vel sapien vitae, ultricies.[/services_steps][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );


$data = array();
$data['name'] = esc_html__( 'Fullwidth Block Half text/Half Image', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'];
$data['custom_class'] = 'block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/30.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_content" bg_position="left top" bg_repeat="no-repeat" text_color="dark" top_padding="0" bottom_padding="0"][vc_column width="1/2" animation="none" background_color_opacity="1" background_image="420"][/vc_column][vc_column width="1/2" animation="none" column_padding="4%" background_color="#ffffff" background_color_opacity="1"][block_title style="column_title" title="What about our new product ?" second_title="Being part of the new web era"][vc_column_text]It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.[/vc_column_text][vc_row_inner][vc_column_inner width="1/2"][list icon="steadysets-icon-checkmark"][list_item title="Build for multiple platforms" desc="A responsive web design will ensure a quality UX for your customers in all platforms." style="titledesc"][list_item title="The right code" desc="It is recommended that your new website be built using both CSS3 and HTML5 languages." style="titledesc"][/list][/vc_column_inner][vc_column_inner width="1/2"][list icon="steadysets-icon-checkmark"][list_item title="Build for multiple platforms" desc="A responsive web design will ensure a quality UX for your customers in all platforms." style="titledesc"][list_item title="The right code" desc="It is recommended that your new website be built using both CSS3 and HTML5 languages." style="titledesc"][/list][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Counter Block Dark', 'specular' );
$data['cat_display_name'] = $cat_display_names['block']. ', '.$cat_display_names['counter'];
$data['custom_class'] = 'block counter';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/28.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" text_color="light" bg_color="#222"][vc_column width="1/1"][block_title style="section_title" title="Fun facts about our work" description="Sed ut perspiciatis unde omnis iste ment natus sit voluptatem ren accusantium rendse dolorem formas humanitatis per seacula quarta."][vc_row_inner][vc_column_inner width="1/4"][counter text="Visits received" icon="linecon-icon-eye" number="87752"][/vc_column_inner][vc_column_inner width="1/4"][counter text="Followers" icon="linecon-icon-bubble" number="4750"][/vc_column_inner][vc_column_inner width="1/4"][counter text="Lines of code" icon="linecon-icon-truck" number="145004"][/vc_column_inner][vc_column_inner width="1/4"][counter text="Active Users" icon="linecon-icon-shop" number="17800"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Services Small Block Fullwidth', 'specular' );
$data['cat_display_name'] = $cat_display_names['block']. ', '.$cat_display_names['services'];
$data['custom_class'] = 'block services';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/27.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_content" bg_position="left top" bg_repeat="no-repeat" bg_color="#f5f5f5" text_color="dark"][vc_column width="2/3" animation="none" column_padding="4%" background_color_opacity="1"][vc_row_inner][vc_column_inner width="1/3" enable_animation="true" animation="fadeIn" delay="400" background_color_opacity="1"][services_small title="Eye-catching innovative blog" icon_bool="yes" icon="linecon-icon-display" dynamic_content_type="content" dynamic_post="33" dynamic_page="122" dynamic_content_link="//codeless.co/specular/default/?page_id=449" dynamic_content_content="Specular comes with a new blog style. Fullscreen blog style is easy to configure and awesome for the client to read the new posts."][services_small title="Real multi-purpose" icon_bool="yes" icon="linecon-icon-diamond" dynamic_content_type="content" dynamic_post="33" dynamic_page="122" dynamic_content_link="#" dynamic_content_content="Unlimited possibilities to create outstanding websites. Unique and useful demos for your next project. Get the best from a $55 theme."][/vc_column_inner][vc_column_inner width="1/3" enable_animation="true" animation="fadeIn" delay="800" background_color_opacity="1"][services_small title="30+ Portfolio Layouts" icon_bool="yes" icon="linecon-icon-params" dynamic_content_type="content" dynamic_post="33" dynamic_page="122" dynamic_content_link="#" dynamic_content_content="Showcasing your projects is easy with Specular. Use Masonry, Grid, Fullwidth or Boxed Layout and all of them with 3 styles and 2-5 columns"][services_small title="Custom Codeless Slider" icon_bool="yes" icon="linecon-icon-news" dynamic_content_type="content" dynamic_post="33" dynamic_page="122" dynamic_content_link="#" dynamic_content_content="A new custom slider for this theme. Use as fullscreen or custom height, video bg or image, predefined layouts and animations"][/vc_column_inner][vc_column_inner width="1/3" enable_animation="true" animation="fadeIn" delay="1200" background_color_opacity="1"][services_small title="Dedicated Support Team" icon_bool="yes" icon="linecon-icon-user" dynamic_content_type="content" dynamic_post="33" dynamic_page="122" dynamic_content_link="#" dynamic_content_content="We have created a dedicated team only for the support and updates. 4 members work every day to ensure you that everything works fine."][services_small title="Created with research" icon_bool="yes" icon="linecon-icon-study" dynamic_content_type="content" dynamic_post="33" dynamic_page="122" dynamic_content_link="#" dynamic_content_content="All new web design features and SEO practices are used for this theme to made it the most useful and successful theme ever created."][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="1/3" animation="none" column_padding="4%" background_color="#f6f8f9" background_color_opacity="1" font_color="#888888"][block_title style="column_title" title="Our ``Modern`` Features"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.

I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit.[/vc_column_text][button title="Read More" link="#" icon="linecon-icon-heart"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Skills Block Dark', 'specular' );
$data['cat_display_name'] = $cat_display_names['block']. ', '.$cat_display_names['skills'];
$data['custom_class'] = 'block skills';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/26.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" text_color="light" parallax_bg="true" bg_color="#1c1c1c"][vc_column width="1/1"][block_title style="section_title" title="We know what we do well" description="Sed ut perspiciatis unde omnis iste ment natus sit voluptatem ren accusantium rendse dolorem formas humanitatis per seacula quarta."][vc_row_inner][vc_column_inner width="1/4"][chart_skill percent="75" text="Web Development" color="#444444"][/vc_column_inner][vc_column_inner width="1/4"][chart_skill percent="84" text="Design &amp; Presentation" color="#444444"][/vc_column_inner][vc_column_inner width="1/4"][chart_skill percent="78" text="Brand &amp; Marketing" color="#444444"][/vc_column_inner][vc_column_inner width="1/4"][chart_skill percent="97" text="Support &amp; Updates" color="#444444"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Team Fullwidth Block', 'specular' );
$data['cat_display_name'] = $cat_display_names['block']. ', '.$cat_display_names['team'];
$data['custom_class'] = 'block team';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/25.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" bg_color="#f7f7f7" text_color="dark" top_padding="30" bottom_padding="30"][vc_column width="1/1"][block_title style="column_title" title="Our great team." second_title="Special professionals for codeless theme"][/vc_column][/vc_row][vc_row type="full_width_content" bg_position="left top" bg_repeat="no-repeat" text_color="dark"][vc_column width="1/1"][staff_carousel pagination="yes"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Team Block', 'specular' );
$data['cat_display_name'] = $cat_display_names['block']. ', '.$cat_display_names['team'];
$data['custom_class'] = 'block tean';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/24.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" bg_color="#f5f5f5" text_color="dark"][vc_column width="1/1"][block_title style="section_title" title="Meet the Specular Team" description="The experts at our Codeless web design agency have more than 10 years of combined experience in web development and design."][vc_row_inner][vc_column_inner width="1/3" enable_animation="true" animation="fadeInUp" delay="200" background_color_opacity="1"][staff staff="141"][/vc_column_inner][vc_column_inner width="1/3" enable_animation="true" animation="fadeInUp" delay="400" background_color_opacity="1"][staff staff="149"][/vc_column_inner][vc_column_inner width="1/3" enable_animation="true" animation="fadeInUp" delay="600" background_color_opacity="1"][staff staff="151"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Block with Lists', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'];
$data['custom_class'] = 'block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/23.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/3"][block_title style="column_title" title="Who we are" second_title="Learn more about us"][vc_column_text]Codeless has been quietly but consistently building a powerhouse portfolio of web site design and marketing success. We have cheerfully and expertly designed, developed, strategized and implemented web marketing programs and wordpress sites for small and large medical clients, non-profit foundations, design agencies, real estate groups and small service clients. Specular includes all our years of experience on doing web.[/vc_column_text][/vc_column][vc_column width="2/3"][block_title style="column_title" title="Why choose us" second_title="Take a look to our business fundamentals"][vc_row_inner][vc_column_inner width="1/2" enable_animation="true" animation="none" background_color_opacity="1"][list icon="steadysets-icon-checkmark"][list_item style="titledesc" title="Build for multiple platforms" desc="A responsive web design will ensure a quality UX for your customers in all platforms."][list_item style="titledesc" title="The right code" desc="It is recommended that your new website be built using both CSS3 and HTML5 languages."][/list][/vc_column_inner][vc_column_inner width="1/2" enable_animation="true" animation="none" background_color_opacity="1"][list icon="steadysets-icon-checkmark"][list_item style="titledesc" title="The content management system" desc="The CMS will simplify all your website tasks. Specular build with Wordpress"][list_item style="titledesc" title="High conversion " desc="Convert a large amount of your visits in sales and success with Specular"][/list][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Blog Modern Inline', 'specular' );
$data['cat_display_name'] = $cat_display_names['blog'];
$data['custom_class'] = 'blog';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/22.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" text_color="light" overlay_color="#428bbf" bg_image="1384" overlay="true"][vc_column width="1/1"][block_title style="section_title" padding_desc="28%" title="Our Latest News"][recent_news posts_per_page="4" dynamic_from_where="all_cat" dynamic_cat="1"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Services Media Block', 'specular' );
$data['cat_display_name'] = $cat_display_names['block']. ', '.$cat_display_names['services'];
$data['custom_class'] = 'block services';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/21.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" bg_color="#f5f5f5" text_color="dark" top_padding="100" bottom_padding="100"][vc_column width="1/1"][block_title style="section_title" padding_desc="28%" title="What we do" description="Phasellus enim libero, blandit vel sapien vitae, condimentum ultricies magna. lobortis aliquam. Aliquam in tortor enim."][vc_row_inner][vc_column_inner width="1/3"][services_media title="Start your business" type="img" photo="1000" link="#"]Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since[/services_media][/vc_column_inner][vc_column_inner width="1/3"][services_media title="Awesome Multi-Purpose Theme" type="img" photo="1077" link="#"]Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since[/services_media][/vc_column_inner][vc_column_inner width="1/3"][services_media title="Drag &amp; drop page builder" type="img" photo="996" link="#"]Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since[/services_media][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Block with Skills and Text', 'specular' );
$data['cat_display_name'] = $cat_display_names['block']. ', '.$cat_display_names['skills'];
$data['custom_class'] = 'block skills';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/20.png' ); 
$data['content'] = <<<EOF
[vc_row type="in_container" bg_position="left top" bg_repeat="no-repeat" text_color="dark"][vc_column width="1/1"][block_title style="section_title" padding_desc="28%" title="We work hard to ensure you the best product"][vc_row_inner][vc_column_inner width="1/3"][vc_column_text]Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.[/vc_column_text][/vc_column_inner][vc_column_inner width="2/3"][skills][skill title="Web design" percentage="70"][skill title="Web development" percentage="85"][skill title="Mobile Design" percentage="55"][skill title="Marketing" percentage="80"][/skills][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Services Only Icon', 'specular' );
$data['cat_display_name'] = $cat_display_names['block']. ', '.$cat_display_names['services'];
$data['custom_class'] = 'block services';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/19.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/3"][services_medium title="Real multi-purpose" icon_bool="yes" icon="linecon-icon-cloud" dynamic_content_type="content" dynamic_post="33" dynamic_page="244" dynamic_content_link="#" style="style_2" icon_color="#222222" circle_color="#f5f5f5"]<span style="color: #777777;">Unlimited possibilities to create outstanding websites. Unique and useful demos for your next project. Get the best from a $55 theme.</span>[/services_medium][services_medium title="Fully Responsive" icon_bool="yes" icon="steadysets-icon-screen" dynamic_content_type="content" dynamic_post="33" dynamic_page="244" dynamic_content_link="#" style="style_2" icon_color="#222222" circle_color="#f5f5f5"]<span style="color: #777777;">Specular comes with fantastic fully responsive feature. Try to resize your browser to change the view. Fully responsive and retina.</span>[/services_medium][/vc_column][vc_column width="1/3"][services_medium title="30+ Portfolio Layouts" icon_bool="yes" icon="linecon-icon-clip" dynamic_content_type="content" dynamic_post="33" dynamic_page="244" dynamic_content_link="#" style="style_2" icon_color="#222222" circle_color="#f5f5f5"]Showcasing your projects is easy with Specular. Use Masonry, Grid, Fullwidth or Boxed Layout and all of them with 3 styles and 2-5 columns[/services_medium][services_medium title="Custom Codeless Slider" icon_bool="yes" icon="linecon-icon-paperplane" dynamic_content_type="content" dynamic_post="33" dynamic_page="244" dynamic_content_link="#" style="style_2" icon_color="#222222" circle_color="#f5f5f5"]<span style="color: #777777;">A new custom slider for this theme. Use as fullscreen or custom height, video bg or image, predefined layouts and animations</span>[/services_medium][/vc_column][vc_column width="1/3"][services_medium title="Extra Side Navigation" icon_bool="yes" icon="linecon-icon-data" dynamic_content_type="content" dynamic_post="33" dynamic_page="244" dynamic_content_link="#" style="style_2" icon_color="#222222" circle_color="#f5f5f5"]<span style="color: #777777;">Add new widgetized area expandable with a button for your clients to fulfill their requests.<span style="color: #555555;">Phasellus enim libero, blandit vel sapien</span></span>[/services_medium][services_medium title="Drag &amp; Drop Builder" icon_bool="yes" icon="linecon-icon-diamond" dynamic_content_type="content" dynamic_post="33" dynamic_page="244" dynamic_content_link="#" style="style_2" icon_color="#222222" circle_color="#f5f5f5"]Easy to use, fast and with frequently updates drag and drop (front-end, back-end) page builder.<span style="color: #555555;">Phasellus enim libero, blandi.</span>[/services_medium][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Fullwidth Block with Texts and BG Color', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'];
$data['custom_class'] = 'block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/18.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_content" bg_position="left top" bg_repeat="no-repeat" text_color="light"][vc_column width="1/3" animation="none" background_color="#8aa2b3" background_color_opacity="1" font_color="#ffffff" column_padding="4%"][block_title title="Unlimited Section Styles" second_title="Sections with image, video or color" style="column_title" padding_desc="28%" inner_style="simple"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column][vc_column width="1/3" animation="none" background_color="#b8d1c2" background_color_opacity="1" font_color="#ffffff" column_padding="4%"][block_title title="Unlimited Columns Styles" second_title="Background, in container, centered" style="column_title" padding_desc="28%"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column][vc_column width="1/3" animation="none" background_color="#99afbd" background_color_opacity="1" font_color="#ffffff" column_padding="4%"][block_title title="Easy to use Page Builder" second_title="Drag &amp; drop front-end builder" style="column_title" padding_desc="28%"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Block with Lists and Image', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'];
$data['custom_class'] = 'block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/17.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" bg_color="#f5f5f5" text_color="dark"][vc_column width="1/1"][block_title style="section_title" padding_desc="28%" title="Lifetime free support and updates" description="Phasellus enim libero, blandit vel sapien vitae, condimentum ultricies magna. lobortis aliquam. Aliquam in tortor enim."][/vc_column][/vc_row][vc_row type="full_width_content" bg_position="left top" bg_repeat="no-repeat" text_color="dark" bg_color="#f5f5f5"][vc_column width="1/2"][media type="image" slideshow="posts" slideshow_post="33" slideshow_page="244" alignment="right" animation="left" image="1280" width="540"][/vc_column][vc_column width="1/2" animation="none" column_padding="5%" background_color_opacity="1"][block_title style="column_title" padding_desc="10%" title="Awesome Multipurpose wordpress theme" description="I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo." second_title="Unlimited Possibilities"][vc_column_text]Codeless has been quietly but consistently building a powerhouse portfolio of web site design and marketing success. We have cheerfully and expertly designed, developed, strategized and implemented web marketing programs and wordpress sites for small and large medical clients, non-profit foundations, design agencies, real estate groups and small service clients.[/vc_column_text][vc_row_inner][vc_column_inner width="1/2"][list icon="linecon-icon-tag"][list_item style="simple" title="Responsive"][list_item style="simple" title="Unique Design"][list_item style="simple" title="Easy Customizable"][list_item style="simple" title="Very fast admin panel"][list_item style="simple" title="Created with clients in mind"][/list][/vc_column_inner][vc_column_inner width="1/2"][list icon="linecon-icon-tag"][list_item style="simple" title="Responsive"][list_item style="simple" title="Unique Design"][list_item style="simple" title="Easy Customizable"][list_item style="simple" title="Very fast admin panel"][list_item style="simple" title="Created with clients in mind"][/list][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );


$data = array();
$data['name'] = esc_html__( 'Services Square', 'specular' );
$data['cat_display_name'] = $cat_display_names['block']. ', '.$cat_display_names['services'] ;
$data['custom_class'] = 'block services';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/15.png' ); 
$data['content'] = <<<EOF
[vc_row type="in_container" bg_position="left top" bg_repeat="no-repeat" bg_color="#ffffff" text_color="dark"][vc_column width="1/3"][services_large title="Custom Typography" icon="linecon-icon-pen" dynamic_content_type="content" dynamic_post="33" dynamic_page="244" dynamic_content_link="#"]<span style="color: #818181;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam.</span>[/services_large][/vc_column][vc_column width="1/3"][services_large title="Retina Display" icon="linecon-icon-display" dynamic_content_type="content" dynamic_post="33" dynamic_page="244" dynamic_content_link="#"]<span style="color: #818181;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam.</span>[/services_large][/vc_column][vc_column width="1/3"][services_large title="Illustration" icon="linecon-icon-paperplane" dynamic_content_type="content" dynamic_post="33" dynamic_page="244" dynamic_content_link="#"]<span style="color: #818181;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam.</span>[/services_large][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Clients Call to Action Block', 'specular' );
$data['cat_display_name'] = $cat_display_names['block']. ', '.$cat_display_names['clients']. ', '.$cat_display_names['cta'] ;
$data['custom_class'] = 'block clients cta';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/14.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" bg_color="#f5f5f5" text_color="dark" top_padding="40" bottom_padding="40"][vc_column width="1/1"][clients dark_light="dark" carousel="yes"][/vc_column][/vc_row][vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" bg_color="base" text_color="light" top_padding="30" bottom_padding="30"][vc_column width="1/1"][textbar title="Are you ready to be part of our 2000+ satisfied clients for only $55 ?" button_bool="yes" button_title="Purchase Now" button_link="//codeless.co/specular/join.php" icon="moon-arrow-right-5" style="style_1"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Testimonial Block', 'specular' );
$data['cat_display_name'] = $cat_display_names['testimonial']. ', '.$cat_display_names['block'];
$data['custom_class'] = 'testimonial block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/13.png' ); 
$data['content'] = <<<EOF
[vc_row type="in_container" bg_position="left top" bg_repeat="no-repeat" text_color="dark"][vc_column width="1/2"][single_testimonial testimon="268"][single_testimonial testimon="269"][/vc_column][vc_column width="1/2"][single_testimonial testimon="269"][single_testimonial testimon="268"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Counter Dark', 'specular' );
$data['cat_display_name'] = $cat_display_names['counter'];
$data['custom_class'] = 'counter';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/12.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" parallax_bg="true" text_color="light" overlay_color="#000000" bottom_padding="80" top_padding="80" bg_image="959" overlay="true"][vc_column width="1/4"][counter text="Visits received" icon="linecon-icon-eye" number="87752"][/vc_column][vc_column width="1/4"][counter text="Followers" icon="linecon-icon-bubble" number="4750"][/vc_column][vc_column width="1/4"][counter text="Lines of code" icon="linecon-icon-truck" number="145004"][/vc_column][vc_column width="1/4"][counter text="Active Users" icon="linecon-icon-shop" number="17800"][/vc_column][/vc_row][vc_row][vc_column width="1/1"][block_title style="section_title" padding_desc="28%" title="What they say"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Portfolio Grid Block', 'specular' );
$data['cat_display_name'] = $cat_display_names['portfolio'].', '.$cat_display_names['grid']. ', '.$cat_display_names['block'];
$data['custom_class'] = 'portfolio grid block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/11.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" bg_color="#f5f5f5" text_color="dark"][vc_column width="1/1"][block_title style="column_title" padding_desc="28%" title="Our Latest Projects" second_title="Have a look to our portfolio"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][recent_portfolio style="overlayed" mode="grid" space="normal" columns="3" rows="1" carousel="no" from_where="cat" category="11"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Services Small Block 2', 'specular' );
$data['cat_display_name'] = $cat_display_names['block']. ', '.$cat_display_names['services'];
$data['custom_class'] = 'block services';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/10.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/1"][block_title style="section_title" padding_desc="0%" title="Get to know our brand" description="Codeless has been quietly but consistently building a powerhouse portfolio of web site design and marketing success. We have cheerfully and expertly designed, developed, strategized and implemented web marketing programs and wordpress sites for small and large medical clients, non-profit foundations, design agencies, real estate groups and small service clients."][/vc_column][/vc_row][vc_row type="in_container" bg_position="left top" bg_repeat="no-repeat" text_color="dark" overlay_color="#f5f5f5"][vc_column width="1/3"][services_small title="Eye-catching innovative blog" icon_bool="yes" icon="linecon-icon-display" dynamic_content_type="content" dynamic_post="33" dynamic_page="122" dynamic_content_link="//codeless.co/specular/default/?page_id=449" dynamic_content_content="Specular comes with a new blog style. Fullscreen blog style is easy to configure and awesome for the client to read the new posts."][/vc_column][vc_column width="1/3"][services_small title="30+ Portfolio Layouts" icon_bool="yes" icon="linecon-icon-params" dynamic_content_type="content" dynamic_post="33" dynamic_page="122" dynamic_content_link="#" dynamic_content_content="Showcasing your projects is easy with Specular. Use Masonry, Grid, Fullwidth or Boxed Layout and all of them with 3 styles and 2-5 columns"][/vc_column][vc_column width="1/3"][services_small title="Dedicated Support Team" icon_bool="yes" icon="linecon-icon-user" dynamic_content_type="content" dynamic_post="33" dynamic_page="122" dynamic_content_link="#" dynamic_content_content="We have created a dedicated team only for the support and updates. 4 members work every day to ensure you that everything works fine."][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Clients', 'specular' );
$data['cat_display_name'] = $cat_display_names['clients'];
$data['custom_class'] = 'clients';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/9.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" text_color="dark" top_padding="40" bottom_padding="40"][vc_column width="1/1"][clients dark_light="dark" carousel="yes"][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Testimonial 1', 'specular' );
$data['cat_display_name'] = $cat_display_names['testimonial'];
$data['custom_class'] = 'testimonial';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/8.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" bg_color="#f5f5f5" text_color="dark"][vc_column width="1/1"][block_title style="section_title" padding_desc="28%" title="What our costumers say"][testimonial_carousel][/vc_column][/vc_row]
EOF;
vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Blog Grid', 'specular' );
$data['cat_display_name'] = $cat_display_names['block']. ', '.$cat_display_names['blog']. ', '.$cat_display_names['grid'];
$data['custom_class'] = 'block blog grid';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/7.png' ); 
$data['content'] = <<<EOF
[vc_row type="in_container" bg_position="left top" bg_repeat="no-repeat" text_color="dark"][vc_column width="1/1"][block_title style="section_title" padding_desc="28%" title="Latest News" second_title="What's going on" description="Phasellus enim libero, blandit vel sapien vitae, condimentum ultricies magna. lobortis aliquam. Aliquam in tortor enim."][latest_blog dynamic_from_where="all_cat" dynamic_cat="1" number_posts="3" carousel="no"][/vc_column][/vc_row]
EOF;

vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Services Small Block', 'specular' );
$data['cat_display_name'] = $cat_display_names['block']. ', '.$cat_display_names['services'];
$data['custom_class'] = 'block services';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/6.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" text_color="dark" overlay_color="#f5f5f5" bg_color="#f5f5f5"][vc_column width="1/1"][vc_row_inner][vc_column_inner width="1/3" enable_animation="true" animation="fadeIn" delay="400" background_color_opacity="1"][services_small title="Eye-catching innovative blog" icon_bool="yes" icon="linecon-icon-display" dynamic_content_type="content" dynamic_post="33" dynamic_page="122" dynamic_content_link="//codeless.co/specular/default/?page_id=449" dynamic_content_content="Specular comes with a new blog style. Fullscreen blog style is easy to configure and awesome for the client to read the new posts." style="style_1" color_icon_wr="#222222" icon_color="#10b8c7"][services_small title="Real multi-purpose" icon_bool="yes" icon="linecon-icon-diamond" dynamic_content_type="content" dynamic_post="33" dynamic_page="122" dynamic_content_link="#" dynamic_content_content="Unlimited possibilities to create outstanding websites. Unique and useful demos for your next project. Get the best from a $55 theme."][services_small title="Video Background" icon_bool="yes" icon="linecon-icon-clip" dynamic_content_type="content" dynamic_post="33" dynamic_page="122" dynamic_content_link="#" dynamic_content_content="Add video background in slider, sections and page headers. Create fantastic creative pages"][/vc_column_inner][vc_column_inner width="1/3" enable_animation="true" animation="fadeIn" delay="800" background_color_opacity="1"][services_small title="30+ Portfolio Layouts" icon_bool="yes" icon="linecon-icon-params" dynamic_content_type="content" dynamic_post="33" dynamic_page="122" dynamic_content_link="#" dynamic_content_content="Showcasing your projects is easy with Specular. Use Masonry, Grid, Fullwidth or Boxed Layout and all of them with 3 styles and 2-5 columns"][services_small title="Custom Codeless Slider" icon_bool="yes" icon="linecon-icon-news" dynamic_content_type="content" dynamic_post="33" dynamic_page="122" dynamic_content_link="#" dynamic_content_content="A new custom slider for this theme. Use as fullscreen or custom height, video bg or image, predefined layouts and animations"][services_small title="Woocommerce Compatible" icon_bool="yes" icon="linecon-icon-shop" dynamic_content_type="content" dynamic_post="33" dynamic_page="122" dynamic_content_link="#" dynamic_content_content="Create your online shop now is easy then ever. In few minutes you can create your online store."][/vc_column_inner][vc_column_inner width="1/3" enable_animation="true" animation="fadeIn" delay="1200" background_color_opacity="1"][services_small title="Dedicated Support Team" icon_bool="yes" icon="linecon-icon-user" dynamic_content_type="content" dynamic_post="33" dynamic_page="122" dynamic_content_link="#" dynamic_content_content="We have created a dedicated team only for the support and updates. 4 members work every day to ensure you that everything works fine."][services_small title="Created with research" icon_bool="yes" icon="linecon-icon-study" dynamic_content_type="content" dynamic_post="33" dynamic_page="122" dynamic_content_link="#" dynamic_content_content="All new web design features and SEO practices are used for this theme to made it the most useful and successful theme ever created."][services_small title="One click demo data" icon_bool="yes" icon="linecon-icon-clock" dynamic_content_type="content" dynamic_post="33" dynamic_page="122" dynamic_content_link="#" dynamic_content_content="With only one click create your site with your preferred demo from our list of demos."][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
EOF;

vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Content Block with Image 2', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'];
$data['custom_class'] = 'block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/5.png' ); 
$data['content'] = <<<EOF
[vc_row type="in_container" bg_position="left top" bg_repeat="no-repeat" text_color="dark"][vc_column width="1/2"][block_title style="column_title" padding_desc="28%" title="Specular on every device" second_title="Responsive, unique, multipurpose"][vc_column_text]<span style="color: #777777;">Codeless has been quietly but consistently building a powerhouse portfolio of web site design and marketing success. </span>

<span style="color: #777777;">We have cheerfully and expertly designed, developed, strategized and implemented web marketing programs and wordpress sites for small and large medical clients, non-profit foundations, design agencies, real estate groups and small service clients. Praesent tincidunt molestie libero mollis porta. Praesent sit amet faucibus leo.
</span>[/vc_column_text][button title="Purchase Now" link="http://themeforest.net/item/specular-responsive-multipurpose-business-theme/9412083?ref=code-less" icon="moon-arrow-right-5" align="left"][/vc_column][vc_column width="1/2"][media type="image" slideshow="posts" slideshow_post="33" slideshow_page="244" alignment="center" animation="right" image="1267" width="380"][/vc_column][/vc_row]
EOF;

vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Counter 1', 'specular' );
$data['cat_display_name'] = $cat_display_names['counter'];
$data['custom_class'] = 'counter';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/4.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" text_color="dark" overlay_color="#f5f5f5" top_padding="100" bottom_padding="100" bg_image="1295" overlay="true" parallax_bg="true"][vc_column width="1/1"][vc_row_inner][vc_column_inner width="1/4"][counter text="Visits received" icon="linecon-icon-eye" number="87752"][/vc_column_inner][vc_column_inner width="1/4"][counter text="Followers" icon="linecon-icon-bubble" number="4750"][/vc_column_inner][vc_column_inner width="1/4"][counter text="Lines of code" icon="linecon-icon-truck" number="145004"][/vc_column_inner][vc_column_inner width="1/4"][counter text="Active Users" icon="linecon-icon-shop" number="17800"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
EOF;

vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Content Block with Image', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'];
$data['custom_class'] = 'block';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/3.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" text_color="dark" bottom_padding="0" top_padding="80"][vc_column width="1/2"][media type="image" slideshow="posts" slideshow_post="33" slideshow_page="244" alignment="center" animation="left" image="1283" width="540"][/vc_column][vc_column width="1/2"][block_title style="column_title" padding_desc="28%" title="Why choose us?" second_title="Responsive, unique, multipurpose"][vc_column_text]<span style="color: #777777;">Codeless has been quietly but consistently building a powerhouse portfolio of web site design and marketing success. </span>

<span style="color: #777777;">We have cheerfully and expertly designed, developed, strategized and implemented web marketing programs and wordpress sites for small and large medical clients, non-profit foundations, design agencies, real estate groups and small service clients. Specular includes all our years of experience on doing web.</span>[/vc_column_text][/vc_column][/vc_row]
EOF;

vc_add_default_templates( $data );

$data = array();
$data['name'] = esc_html__( 'Portfolio Grid & Call To Action', 'specular' );
$data['cat_display_name'] = $cat_display_names['block'] . ', ' . $cat_display_names['portfolio'] . ', ' . $cat_display_names['grid'];
$data['custom_class'] = 'block portfolio grid';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/2.png' ); 
$data['content'] = <<<EOF
[vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" bg_color="#f7f7f7" text_color="dark" top_padding="60" bottom_padding="45"][vc_column width="1/1"][block_title title="Our Latest Projects" second_title="Some of our featured works" style="section_title" padding_desc="28%" description="Phasellus enim libero, blandit vel sapien vitae, condimentum ultricies magna. lobortis aliquam. Aliquam in tortor enim."][/vc_column][/vc_row][vc_row type="full_width_content" bg_position="left top" bg_repeat="no-repeat" text_color="dark"][vc_column width="1/1"][recent_portfolio style="grayscale" mode="grid" space="no_space" columns="4" rows="1" carousel="no" from_where="all_cat" category="14"][/vc_column][/vc_row][vc_row type="full_width_background" bg_position="left top" bg_repeat="no-repeat" bg_color="base" text_color="light" top_padding="30" bottom_padding="30"][vc_column width="1/1"][textbar title="Are you ready to be part of our 2000+ satisfied clients for only $55 ?" button_bool="yes" button_title="Purchase Now" button_link="//codeless.co/specular/join.php" icon="moon-arrow-right-5" style="style_1"][/vc_column][/vc_row]
EOF;

vc_add_default_templates( $data );


$data = array();
$data['name'] = esc_html__( 'Services Circle', 'specular' );
$data['cat_display_name'] = $cat_display_names['services'];
$data['custom_class'] = 'services';
$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() .'/img/templates/1.png' ); 
$data['content'] = <<<EOF
[vc_row][vc_column width="1/4"][services_medium title="Parallax Sections" icon_bool="yes" icon="linecon-icon-fire" dynamic_content_type="content" dynamic_post="33" dynamic_page="122" dynamic_content_link="#"]Create parallax sections with animations. Use parallax on inner page sections or in slider[/services_medium][/vc_column][vc_column width="1/4"][services_medium title="Multimedia Slides" icon_bool="yes" icon="linecon-icon-photo" dynamic_content_type="content" dynamic_post="33" dynamic_page="122" dynamic_content_link="#"]Create awesome slides with mixed multimedia content: video, photos with content, parallax, fullscreen.[/services_medium][/vc_column][vc_column width="1/4"][services_medium title="Extra Side Navigation" icon_bool="yes" icon="linecon-icon-paperplane" dynamic_content_type="content" dynamic_post="33" dynamic_page="122" dynamic_content_link="#"]Add new widgetized area expandable with a button for your clients to fulfill their requests.[/services_medium][/vc_column][vc_column width="1/4"][services_medium title="Theme Customizer" icon_bool="yes" icon="linecon-icon-eye" dynamic_content_type="content" dynamic_post="33" dynamic_page="122" dynamic_content_link="#"]Easy change colors and styles from wordpress theme customizer. Make your work easier.[/services_medium][/vc_column][/vc_row]
EOF;

vc_add_default_templates( $data );





}

?>