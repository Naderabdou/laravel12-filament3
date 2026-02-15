<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    // Site Info
    public string $site_name_ar;
    public string $site_name_en;
    public string $logo = 'settings/logo.png';
    public string $logo_footer = 'settings/logo_footer.png';
    public string $favicon = 'settings/favicon.png';

    // Default Section
    public string $title_default_ar;
    public string $title_default_en;
    public string $desc_default_ar;
    public string $desc_default_en;

    // Hero Section
    public string $hero_image = 'settings/hero_image.png';
    public string $hero_span_ar;
    public string $hero_span_en;
    public string $hero_title_one_ar;
    public string $hero_title_one_en;
    public string $hero_title_two_ar;
    public string $hero_title_two_en;
    public string $hero_desc_ar;
    public string $hero_desc_en;

    // About Section
    public string $title_about_ar;
    public string $title_about_en;
    public string $desc_about_ar;
    public string $desc_about_en;
    public string $image_about_one;
    public string $image_about_two;
    public string $image_about_three;
    public string $about_years;
    public string $our_value_ar;
    public string $our_value_en;
    public string $vision_ar;
    public string $vision_en;
    public string $goals_ar;
    public string $goals_en;
    public string $des_goals_one_ar;
    public string $des_goals_one_en;
    public string $title_goals_one_ar;
    public string $title_goals_one_en;
    public string $des_goals_two_ar;
    public string $des_goals_two_en;
    public string $title_goals_two_ar;
    public string $title_goals_two_en;
    public string $des_goals_three_ar;
    public string $des_goals_three_en;
    public string $title_goals_three_ar;
    public string $title_goals_three_en;
    public string $des_goals_four_ar;
    public string $des_goals_four_en;
    public string $title_goals_four_ar;
    public string $title_goals_four_en;

    // Blog Section
    public string $blog_title_ar;
    public string $blog_title_en;
    public string $blog_desc_ar;
    public string $blog_desc_en;

    // FAQ Section
    public string $faq_title_ar;
    public string $faq_title_en;
    public string $faq_desc_ar;
    public string $faq_desc_en;

    // News Section
    public string $news_title_ar;
    public string $news_title_en;
    public string $news_desc_ar;
    public string $news_desc_en;

    // Arbitration Centers Section
    public string $arbitration_centers_title_ar;
    public string $arbitration_centers_title_en;
    public string $arbitration_centers_desc_ar;
    public string $arbitration_centers_desc_en;

    // Committee Forms Section
    public string $committee_form_title_ar;
    public string $committee_form_title_en;
    public string $committee_form_desc_ar;
    public string $committee_form_desc_en;

    // Committee Decisions & Circulars Section
    public string $committee_decisions_and_circulars_title_ar;
    public string $committee_decisions_and_circulars_title_en;
    public string $committee_decisions_and_circulars_desc_ar;
    public string $committee_decisions_and_circulars_desc_en;

    // Committee Systems Section
    public string $committee_systems_title_ar;
    public string $committee_systems_title_en;
    public string $committee_systems_desc_ar;
    public string $committee_systems_desc_en;

    // Committee Regulations Section
    public string $committee_regulations_title_ar;
    public string $committee_regulations_title_en;
    public string $committee_regulations_desc_ar;
    public string $committee_regulations_desc_en;

    // Contact Section
    public string $contact_title_ar;
    public string $contact_title_en;
    public string $contact_desc_ar;
    public string $contact_desc_en;
    public string $whatsapp;
    public string $twitter;
    public string $linkedin;
    public string $instagram;
    public string $phone;
    public string $email;
    public string $facebook;
    public string $address;
    public string|array $location;

    // Gallery Section
    public string $gallery_title_ar;
    public string $gallery_title_en;

    // Footer Section
    public string $footer_desc_ar;
    public string $footer_desc_en;
    public string $footer_copyright_ar;
    public string $footer_copyright_en;
    public string $footer_image;

    public static function group(): string
    {
        return 'general';
    }
}
