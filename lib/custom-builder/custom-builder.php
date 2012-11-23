<?php

/*
 * The content below is a copy of bootstrap's variables.less file.
 * 
 * Some options are user-configurable and stored as theme mods.
 * We try to minimize the options and simplify the user environment.
 * In order to do that, we 'll have to provide a minimum amunt of options 
 * and calculate the rest based on the user's selections.
 * 
 * based on the textcolor and bodybackground, we can calculate the following options:
 * @black, @grayDarker, @grayDark, @gray, @grayLight, @grayLighter, @white
 * 
 * based on the baseBorderRadius we can calculate the borderRadiusLarge and borderRadiusSmall.
 * 
 * Only one option per button color is necessary.
 * 
 * The forms and dropdowns can both be derived from the text and background colors.
 * baseLineHeight can also be calculated from the baseFontSize,
 * but it's preferable to have a separate setting for that,
 * since some fonts have weirdline height (especially if using Google Webfonts.)
 * 
 * The "form states and alerts" section can also be completely automated.
 * We can derive colors from other settings and based on the bodyBackground,
 * make the colors we need. :)
 * 
 * Responsive and layouts in general will be a little trickier,
 * we'll have to find a way to make is a simple and intuitive as possible.
 */
function shoestrap_custom_builder_rewrite_variables() {
  $bodyBackground     = '#fff';
  $textColor          = '#333';
  $blue               = '#049cdb';
  $blueDark           = '#0064cd';
  $green              = '#46a546';
  $red                = '#9d261d';
  $yellow             = '#ffc40d';
  $orange             = '#f89406';
  $pink               = '#c3325f';
  $purple             = '#7a43b6';
  $linkColor          = '#08c';
  $sansFontFamily     = '"Helvetica Neue", Helvetica, Arial, sans-serif';
  $serifFontFamily    = 'Georgia, "Times New Roman", Times, serif';
  $monoFontFamily     = 'Monaco, Menlo, Consolas, "Courier New", monospace';
  $baseFontSize       = 14;
  $baseLineHeight     = 20;
  $fontSizeLarge      = 1.25;
  $fontSizeSmall      = 0.85;
  $fontSizeMini       = 0.75;
  $baseBorderRadius   = 4;
  $btnPrimaryBackground   = '@linkColor';
  $btnBackgroundHighlight = 'darken(' . $bodyBackground . ', 10%)';
  $btnInfoBackground      = '#5bc0de';
  $btnSuccessBackground   = '#62c462';
  $btnWarningBackground   = 'lighten(@orange, 15%)';
  $btnDangerBackground    = '#ee5f5b';
  $btnDangerBackground    = '#ee5f5b';
  
  
  // calculate shadows of gray, depending on background and textcolor
  if ( shoestrap_get_brightness( $bodyBackground ) >= 128 ) {
    $black        = shoestrap_adjust_brightness( $textColor, 64 );
    $grayDarker   = shoestrap_adjust_brightness( $textColor, 32 );
  } else {
    $black        = shoestrap_adjust_brightness( $textColor, -64 );
    $grayDarker   = shoestrap_adjust_brightness( $textColor, -17 );
  }
  $grayDark     = $textColor;
  $gray         = shoestrap_mix_colors( $textColor, $bodyBackground, 83 );
  $grayLight    = shoestrap_mix_colors( $textColor, $bodyBackground, 50 );
  $grayLighter  = shoestrap_mix_colors( $textColor, $bodyBackground, 8 );
  $white        = $bodyBackground;
  
  $borderRadiusLarge  = round( $baseBorderRadius * 1.5 );
  $borderRadiusSmall  = round( $baseBorderRadius * 3 / 4 );

  // Link color (on hover) based on background brightness
  if ( shoestrap_get_brightness( $bodyBackground ) >= 50 ) {
    $linkColorHover = 'darken(@linkColor, 15%)';
  } else {
    $linkColorHover = 'lighten(@linkColor, 15%)';
  }
  
  // Table accents and border based on bodyBackground
  if ( shoestrap_get_brightness( $bodyBackground ) >= 50 ) {
    $tableBackgroundAccent  = shoestrap_adjust_brightness( $bodyBackground, -6 );
    $tableBackgroundHover   = shoestrap_adjust_brightness( $bodyBackground, -10 );
    $tableBorder            = shoestrap_adjust_brightness( $bodyBackground, -34 );
  } else {
    $tableBackgroundAccent  = shoestrap_adjust_brightness( $bodyBackground, 6 );
    $tableBackgroundHover   = shoestrap_adjust_brightness( $bodyBackground, 10 );
    $tableBorder            = shoestrap_adjust_brightness( $bodyBackground, 34 );
  }

  // locate the variables file
  $variables_file = locate_template( '/assets/css/bootstrap-less/variables.less' );
  // open the variables file
  $fh = fopen($variables_file, 'w');
  // the content of the variables file
  $variables_content = '//
// Variables
// --------------------------------------------------


// Global values
// --------------------------------------------------


// Grays
// -------------------------
@black:                 ' . $black . ';
@grayDarker:            ' . $grayDarker . ';
@grayDark:              ' . $grayDark . ';
@gray:                  ' . $gray . ';
@grayLight:             ' . $grayLight . ';
@grayLighter:           ' . $grayLighter . ';
@white:                 ' . $white . ';


// Accent colors
// -------------------------
@blue:                  ' . $blue . ';
@blueDark:              ' . $blueDark . ';
@green:                 ' . $green . ';
@red:                   ' . $red . ';
@yellow:                ' . $yellow . ';
@orange:                ' . $orange . ';
@pink:                  ' . $pink . ';
@purple:                ' . $purple . ';


// Scaffolding
// -------------------------
@bodyBackground:        ' . $bodyBackground . ';
@textColor:             ' . $textColor . ';


// Links
// -------------------------
@linkColor:             ' . $linkColor . ';
@linkColorHover:        ' . $linkColorHover . ';


// Typography
// -------------------------
@sansFontFamily:        ' . $sansFontFamily . ';
@serifFontFamily:       ' . $serifFontFamily . ';
@monoFontFamily:        ' . $monoFontFamily . ';

@baseFontSize:          ' . $baseFontSize . 'px;
@baseFontFamily:        @sansFontFamily;
@baseLineHeight:        ' . $baseLineHeight . 'px;
@altFontFamily:         @serifFontFamily;

@headingsFontFamily:    inherit; // empty to use BS default, @baseFontFamily
@headingsFontWeight:    bold;    // instead of browser default, bold
@headingsColor:         inherit; // empty to use BS default, @textColor


// Component sizing
// -------------------------
// Based on 14px font-size and 20px line-height

@fontSizeLarge:         @baseFontSize * ' . $fontSizeLarge . '; // ~18px
@fontSizeSmall:         @baseFontSize * ' . $fontSizeSmall . '; // ~12px
@fontSizeMini:          @baseFontSize * ' . $fontSizeMini . '; // ~11px

@paddingLarge:          11px 19px; // 44px
@paddingSmall:          2px 10px;  // 26px
@paddingMini:           1px 6px;   // 24px

@baseBorderRadius:      ' . $baseBorderRadius . 'px;
@borderRadiusLarge:     ' . $borderRadiusLarge . 'px;
@borderRadiusSmall:     ' . $borderRadiusSmall . 'px;


// Tables
// -------------------------
@tableBackground:                   transparent; // overall background-color
@tableBackgroundAccent:             ' . $tableBackgroundAccent . '; // for striping
@tableBackgroundHover:              ' . $tableBackgroundHover . '; // for hover
@tableBorder:                       ' . $tableBorder . '; // table and cell border

// Buttons
// -------------------------
@btnBackground:                     ' . $bodyBackground . ';
@btnBackgroundHighlight:            darken(@white, 10%);

@btnPrimaryBackground:              ' . $btnPrimaryBackground . ';
@btnPrimaryBackgroundHighlight:     spin(@btnPrimaryBackground, 20%);

@btnInfoBackground:                 ' . $btnInfoBackground . ';
@btnInfoBackgroundHighlight:        darken(spin(@btnInfoBackground, 15%), 7%);

@btnSuccessBackground:              ' . $btnSuccessBackground . ';
@btnSuccessBackgroundHighlight:     darken(spin(@btnSuccessBackground, 15%), 7%);

@btnWarningBackground:              ' . $btnWarningBackground . ';
@btnWarningBackgroundHighlight:     darken(@btnWarningBackground, 15%);

@btnDangerBackground:               ' . $btnDangerBackground . ';
@btnDangerBackgroundHighlight:      darken(spin(@btnDangerBackground, 15%), 7%);

@btnInverseBackground:              @grayDark;
@btnInverseBackgroundHighlight:     darken(@grayDark, 10%);


// Forms
// -------------------------
@inputBackground:               @white;
@inputBorder:                   #ccc;
@inputBorderRadius:             @baseBorderRadius;
@inputDisabledBackground:       @grayLighter;
@formActionsBackground:         #f5f5f5;
@inputHeight:                   @baseLineHeight + 10px; // base line-height + 8px vertical padding + 2px top/bottom border


// Dropdowns
// -------------------------
@dropdownBackground:            @white;
@dropdownBorder:                rgba(0,0,0,.2);
@dropdownDividerTop:            #e5e5e5;
@dropdownDividerBottom:         @white;

@dropdownLinkColor:             @grayDark;
@dropdownLinkColorHover:        @white;
@dropdownLinkColorActive:       @dropdownLinkColor;

@dropdownLinkBackgroundActive:  @linkColor;
@dropdownLinkBackgroundHover:   @dropdownLinkBackgroundActive;



// COMPONENT VARIABLES
// --------------------------------------------------


// Z-index master list
// -------------------------
// Used for a birds eye view of components dependent on the z-axis
// Try to avoid customizing these :)
@zindexDropdown:          1000;
@zindexPopover:           1010;
@zindexTooltip:           1030;
@zindexFixedNavbar:       1030;
@zindexModalBackdrop:     1040;
@zindexModal:             1050;


// Sprite icons path
// -------------------------
@iconSpritePath:          "../img/glyphicons-halflings.png";
@iconWhiteSpritePath:     "../img/glyphicons-halflings-white.png";


// Input placeholder text color
// -------------------------
@placeholderText:         @grayLight;


// Hr border color
// -------------------------
@hrBorder:                @grayLighter;


// Horizontal forms & lists
// -------------------------
@horizontalComponentOffset:       180px;


// Wells
// -------------------------
@wellBackground:                  #f5f5f5;


// Navbar
// -------------------------
@navbarCollapseWidth:             979px;
@navbarCollapseDesktopWidth:      @navbarCollapseWidth + 1;

@navbarHeight:                    40px;
@navbarBackgroundHighlight:       #ffffff;
@navbarBackground:                darken(@navbarBackgroundHighlight, 5%);
@navbarBorder:                    darken(@navbarBackground, 12%);

@navbarText:                      #777;
@navbarLinkColor:                 #777;
@navbarLinkColorHover:            @grayDark;
@navbarLinkColorActive:           @gray;
@navbarLinkBackgroundHover:       transparent;
@navbarLinkBackgroundActive:      darken(@navbarBackground, 5%);

@navbarBrandColor:                @navbarLinkColor;

// Inverted navbar
@navbarInverseBackground:                #111111;
@navbarInverseBackgroundHighlight:       #222222;
@navbarInverseBorder:                    #252525;

@navbarInverseText:                      @grayLight;
@navbarInverseLinkColor:                 @grayLight;
@navbarInverseLinkColorHover:            @white;
@navbarInverseLinkColorActive:           @navbarInverseLinkColorHover;
@navbarInverseLinkBackgroundHover:       transparent;
@navbarInverseLinkBackgroundActive:      @navbarInverseBackground;

@navbarInverseSearchBackground:          lighten(@navbarInverseBackground, 25%);
@navbarInverseSearchBackgroundFocus:     @white;
@navbarInverseSearchBorder:              @navbarInverseBackground;
@navbarInverseSearchPlaceholderColor:    #ccc;

@navbarInverseBrandColor:                @navbarInverseLinkColor;


// Pagination
// -------------------------
@paginationBackground:                #fff;
@paginationBorder:                    #ddd;
@paginationActiveBackground:          #f5f5f5;


// Hero unit
// -------------------------
@heroUnitBackground:              @grayLighter;
@heroUnitHeadingColor:            inherit;
@heroUnitLeadColor:               inherit;


// Form states and alerts
// -------------------------
@warningText:             #c09853;
@warningBackground:       #fcf8e3;
@warningBorder:           darken(spin(@warningBackground, -10), 3%);

@errorText:               #b94a48;
@errorBackground:         #f2dede;
@errorBorder:             darken(spin(@errorBackground, -10), 3%);

@successText:             #468847;
@successBackground:       #dff0d8;
@successBorder:           darken(spin(@successBackground, -10), 5%);

@infoText:                #3a87ad;
@infoBackground:          #d9edf7;
@infoBorder:              darken(spin(@infoBackground, -10), 7%);


// Tooltips and popovers
// -------------------------
@tooltipColor:            #fff;
@tooltipBackground:       #000;
@tooltipArrowWidth:       5px;
@tooltipArrowColor:       @tooltipBackground;

@popoverBackground:       #fff;
@popoverArrowWidth:       10px;
@popoverArrowColor:       #fff;
@popoverTitleBackground:  darken(@popoverBackground, 3%);

// Special enhancement for popovers
@popoverArrowOuterWidth:  @popoverArrowWidth + 1;
@popoverArrowOuterColor:  rgba(0,0,0,.25);



// GRID
// --------------------------------------------------


// Default 940px grid
// -------------------------
@gridColumns:             12;
@gridColumnWidth:         60px;
@gridGutterWidth:         20px;
@gridRowWidth:            (@gridColumns * @gridColumnWidth) + (@gridGutterWidth * (@gridColumns - 1));

// 1200px min
@gridColumnWidth1200:     70px;
@gridGutterWidth1200:     30px;
@gridRowWidth1200:        (@gridColumns * @gridColumnWidth1200) + (@gridGutterWidth1200 * (@gridColumns - 1));

// 768px-979px
@gridColumnWidth768:      42px;
@gridGutterWidth768:      20px;
@gridRowWidth768:         (@gridColumns * @gridColumnWidth768) + (@gridGutterWidth768 * (@gridColumns - 1));


// Fluid grid
// -------------------------
@fluidGridColumnWidth:    percentage(@gridColumnWidth/@gridRowWidth);
@fluidGridGutterWidth:    percentage(@gridGutterWidth/@gridRowWidth);

// 1200px min
@fluidGridColumnWidth1200:     percentage(@gridColumnWidth1200/@gridRowWidth1200);
@fluidGridGutterWidth1200:     percentage(@gridGutterWidth1200/@gridRowWidth1200);

// 768px-979px
@fluidGridColumnWidth768:      percentage(@gridColumnWidth768/@gridRowWidth768);
@fluidGridGutterWidth768:      percentage(@gridGutterWidth768/@gridRowWidth768);
';
  
  // write the content to the variations file
  fwrite($fh, $variables_content);
  // close the file
  fclose($fh);
}
add_action( 'wp', 'shoestrap_custom_builder_rewrite_variables' );
