@php

  $hero_type = get_alps_field( 'hero_type' );
  if ( $hero_type == 'false' || $hero_type == NULL )  {
    $hero = false;
  } else {
    $hero = true;
    if ( $hero_type == 'full' ) {
      $hero_image[]       = get_alps_field( 'hero_image' );
      $block_group_class  = 'u-flex--justify-center u-overlay--dark';
      $block_title_class  = 'l-grid-item--5-col l-grid-item--m--2-col u-font--primary--xl u-flex--justify-center';
      $scroll_class       = '';
      if ( get_alps_field( 'hero_scroll_hint' ) ) {
        $scroll_class = ' has-scroll';
      }
      if ( get_alps_field( 'hero_image_extended' ) ) {
        $block_content_class  = 'l-grid--7-col l-grid-wrap l-grid-wrap--7-of-7 u-color--white';
        $block_class          = 'c-block__full c-media-block__full' . $scroll_class;
      } else {
        $block_content_class  = 'l-grid--7-col l-grid-wrap l-grid-wrap--7-of-7 u-color--white';
        $block_class          = 'c-block__full c-media-block__full l-grid-wrap l-grid-wrap--6-of-7' . $scroll_class;
      }
    } elseif ( $hero_type == 'column' ) {
        $hero_image           = get_alps_field( 'hero_column' );
        $block_class          = 'c-block__column c-media-block__column';
        $block_group_class    = 'u-flex--justify-center u-overlay--dark';
        $block_content_class  = 'u-color--white';
        $block_title_class    = 'u-font--primary--xl u-flex--justify-center';
    } elseif ( $hero_type == 'default' ) {
        $hero_image[]       = get_alps_field( 'hero_image' );
        $block_class        = 'c-block__inset c-media-block__inset';
        $block_title_class  = 'l-grid-item l-grid-item--l--4-col l-grid-item--xl--3-col u-font--primary--xl';
        $block_meta_class   = 'l-grid-item l-grid-item--l--2-col l-grid-item--xl--2-col';
      if ( get_alps_field( 'hero_image_extended' ) ) {
        $block_img_class      = 'l-grid-wrap l-grid-wrap--7-of-7';
        $block_content_class  = 'l-grid--7-col l-grid-wrap l-grid-wrap--7-of-7 u-shift--left--1-col--at-xxlarge u-border-left--white--at-large u-theme--background-color--darker u-color--white';
        $block_group_class    = ' ';
      } else {
        $block_content_class = 'l-grid--7-col l-grid-wrap l-grid-wrap--6-of-7 u-theme--background-color--darker u-color--white';
      }
    }
  }
@endphp
@if ($hero)
  <header class="c-hero c-page-header c-page-header__feature @if($hero_type == 'column'){{ 'c-page-header__3-col' }}@endif @if( get_alps_field( 'hero_scroll_hint' ) ) {{ $scroll_class }} @endif">
    <div class="c-page-header__content">
      @foreach ( $hero_image as $image )
        @php
          if ( $hero_type == 'column' ) {
            $thumb_id   = $image[ 'hero_image_column' ];
            $eyebrow    = $image[ 'hero_kicker_column' ];
            $title      = $image[ 'hero_title_column' ];
            $link       = NULL;
            if ( $image[ 'hero_link_url_column' ] ) {
              $link = $image[ 'hero_link_url_column' ];
            }
          } else {
            $thumb_id   = get_alps_field( 'hero_image' );
            $title      = get_alps_field( 'hero_title' );
            $category   = NULL;
            $link       = NULL;
            if ( get_alps_field( 'hero_kicker' ) ) {
              $category = get_alps_field( 'hero_kicker' );
            }
            if ( get_alps_field( 'hero_link_url' ) ) {
              $link = get_alps_field( 'hero_link_url' );
            }
          }
          if ( $hero_type == 'default' ) {
            $thumb_size     = 'featured__hero';
            $image_break_m  = '500';
            $image_break_l  = '800';
            $image_break_xl = '1100';
          } else {
            $background_image = true;
            $thumb_size     = 'flex-height';
            $image_break_m  = '350';
            $image_break_l  = '700';
            $image_break_xl = '900';
          }
          $picture  = true;
          $image_s  = wp_get_attachment_image_src( $thumb_id, $thumb_size . '--s' )[0];
          $image_m  = wp_get_attachment_image_src( $thumb_id, $thumb_size . '--m' )[0];
          $image_l  = wp_get_attachment_image_src( $thumb_id, $thumb_size . '--l' )[0];
          $image_xl = wp_get_attachment_image_src( $thumb_id, $thumb_size . '--xl' )[0];
          $alt      = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );
        @endphp
        @include('patterns.01-molecules.blocks.media-block')
      @endforeach
    </div>
    @if ( get_alps_field( 'hero_scroll_hint' ) == true )
      <a href="#top" class="c-page-header__scroll"></a>
    @endif
  </header> <!-- /.c-page-header -->
@else
  @include('patterns.02-organisms.sections.page-header')
@endif
