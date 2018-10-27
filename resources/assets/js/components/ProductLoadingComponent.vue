<template>
    <div>
        <div class="card-container">
            <div class="card">
                <div class="card-crown">
                    <ul class="card-types">
                        <li><a></a></li>
                    </ul>
                    <ul class="card-insights">
                        <li></li>
                        <li></li>
                    </ul>
                </div>
                <!-- /.card-crown -->
                <div class="card-header">
                    <div class="card-hero">
                        <div class="card-image"></div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-footer">
                    <h3 class="card-title"></h3>
                    <ul class="card-meta">
                        <li></li>
                        <li></li>
                    </ul>
                    <div class="card-text">
                        <span></span>
                    </div>
                    <div class="card-base">
                        <ul class="card-tags">
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <!-- /.card-base -->
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.card-container -->
    </div>
</template>

<script>
    export default {
        name: "auction-loading-component"
    }
</script>

<style lang="scss">

    /* ====================
            Variables
       ==================== */


    //
    // Colors
    //

    $heading-color: #444;
    $subheading-color: #777;
    $meta-color: #999;
    $text-color: #666;

    $white: rgba(#fff, 0.9);
    $black: rgba(#222, 0.9);


    //
    // Elements
    //

    $padding: 30px;
    $padding-xs: 20px;


    //
    // Boostrap-Sass Breakpoints
    //

    $screen-xs:                  480px !default;
    $screen-xs-min:              $screen-xs !default;
    $screen-sm:                  768px !default;
    $screen-sm-min:              $screen-sm !default;
    $screen-md:                  992px !default;
    $screen-md-min:              $screen-md !default;
    $screen-lg:                  1200px !default;
    $screen-lg-min:              $screen-lg !default;


    //
    // Bootstrap-Sass Grid
    //

    $grid-columns:              12 !default;
    $grid-gutter-width:         30px !default;
    $grid-float-breakpoint:     $screen-sm-min !default;




    /* ====================
              Mixins
       ==================== */

    //
    // Line Limiter
    //

    @mixin lineLimiter($line-height: 1.2em, $line-count: 1, $bg-color: #fff) {
        overflow: hidden;
        position: relative;
        line-height: $line-height;
        max-height: $line-height * $line-count;
        margin-right: -1em;
        padding-right: 1em;

        p {
            margin: 0;
        }

        p:not(:first-child) {
            display: none;
        }

        &.has-overflow::before {
            bottom: 0;
            content: '...';
            letter-spacing: 0.1em;
            font-weight: bold;
            font-size: 1.25em;
            line-height: $line-height;
            position: absolute;
            right: 1em;
            z-index: 5;
        }

        &.has-overflow::after {
            position: absolute;
            bottom: 0;
            right: 0;
            height: $line-height;
            width: 85px;
            content: '';
            background-image: linear-gradient(to right, rgba($white, 0) 30%, rgba(255, 255, 255, 0.85) 38%, rgba(255, 255, 255, 1) 40%);
        }
    }


    //
    // Bootstrap-Sass Grid
    //

    @mixin make-xs-column($columns, $gutter: $grid-gutter-width) {
        position: relative;
        float: left;
        width: percentage(($columns / $grid-columns));
        min-height: 1px;
        padding-left:  ($gutter / 2);
        padding-right: ($gutter / 2);
    }
    @mixin make-sm-column($columns, $gutter: $grid-gutter-width) {
        position: relative;
        min-height: 1px;
        padding-left:  ($gutter / 2);
        padding-right: ($gutter / 2);

        @media (min-width: $screen-sm-min) {
            float: left;
            width: percentage(($columns / $grid-columns));
        }
    }
    @mixin make-md-column($columns, $gutter: $grid-gutter-width) {
        position: relative;
        min-height: 1px;
        padding-left:  ($gutter / 2);
        padding-right: ($gutter / 2);

        @media (min-width: $screen-md-min) {
            float: left;
            width: percentage(($columns / $grid-columns));
        }
    }
    @mixin make-lg-column($columns, $gutter: $grid-gutter-width) {
        position: relative;
        min-height: 1px;
        padding-left:  ($gutter / 2);
        padding-right: ($gutter / 2);

        @media (min-width: $screen-lg-min) {
            float: left;
            width: percentage(($columns / $grid-columns));
        }
    }


    //
    // Breakpoint Mixin
    //

    @mixin break($point) {
        @if ($point == xx) {
            @media (max-width: ($screen-xs-min - 1)) {
                @content;
            }
        }

        @else if ($point == xs) {
            @media (min-width: $screen-xs-min) {
                @content;
            }
        }

        @else if ($point == sm) {
            @media (min-width: $screen-sm-min) {
                @content;
            }
        }

        @else if ($point == md) {
            @media (min-width: $screen-md-min) {
                @content;
            }
        }

        @else if ($point == lg) {
            @media (min-width: $screen-lg-min) {
                @content;
            }
        }
    }


    //
    // Clearfix
    //

    @mixin clearfix() {
        &:before,
        &:after {
            content: " ";
            display: table;
        }
        &:after {
            clear: both;
        }
    }


    //
    // Hardware Acceleration
    //

    @mixin hardware($backface: true, $perspective: 1000) {
        @if $backface {
            backface-visibility: hidden;
        }
        perspective: $perspective;
    }


    //
    // Truncate
    //

    @mixin truncate($truncation-boundary: auto) {
        max-width: $truncation-boundary;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }




    /* ====================
              Resets
       ==================== */

    ul,
    li {
        margin: 0;
        padding: 0;
        list-style-type: none;
    }

    a,
    a:hover {
        color: inherit;
        text-decoration: none;
        cursor: pointer;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        margin: 0;
    }



    /* ====================
              Styles
       ==================== */
    //
    // Card-Container
    //

    .card-container {
        @include clearfix;
        @include make-xs-column(12);
        @include make-md-column(6);
        @include make-lg-column(4);

        margin: 30px auto;
    }


    //
    // Common
    //

    .card,
    .card-actions,
    .card-base,
    .card-crown,
    .card-footer,
    .card-header,
    .card-insights,
    .card-meta,
    .card-tags,
    .card-token,
    .card-types {
        display: flex;
    }

    .card,
    .card-header,
    .card-footer {
        flex-direction: column;
    }

    .card-crown,
    .card-base {
        justify-content: space-between;
    }

    .card-types,
    .card-insights {
        overflow: hidden;
    }

    .card-types,
    .card-tags {
        justify-content: flex-start;
    }

    .card-insights li,
    .card-actions li {
        &:not(:first-child) {
            margin-left: 1.5em;
        }
    }

    .card-types li,
    .card-types li a,
    .card-insights li,
    .card-insights li a {
        color: #fff;
    }


    //
    // Card
    //

    .card {
        @include hardware();
        background-color: #fff;
        border-radius: 4px 4px 5px 5px;
        box-shadow: 0 3px 1px rgba(#000, 0.06);
        margin: 0 auto;
        max-width: 600px;
        min-width: 250px;
        position: relative;
        transition: box-shadow 300ms linear;
        z-index: 1;
        // user-select: none;
    }

    .card:active,
    .card:hover {
        box-shadow: 0 5px 10px rgba(#000, 0.18);
        z-index: 10;
    }


    //
    // Card Crown
    //

    .card-crown {
        align-items: center;
        background-color: lightslategray;
        border-radius: 4px 4px 0 0;
        box-shadow: 0 1px 3px rgba(#000, 0.22);
        height: 50px;
        overflow: hidden;
        padding: 0 $padding-xs;
        z-index: 3;

        @include break(xs) {
            padding: 0 $padding;
        }
    }


    .card-crown,
    .card-footer {
        transition: padding 300ms linear;
    }


    //
    // Card Types
    //

    .card-types {
        flex-shrink: 0;
        white-space: nowrap;
        letter-spacing: .05em;
    }

    .card-types li {
        margin-right: 1em;
    }

    .card-types li:not(:first-child) {
        display: none;
    }


    //
    // Card Insights
    //

    .card-insights,
    .card-insights li {
        @include truncate();
    }


    //
    // Card Header
    //

    .card-header {
        position: relative;
    }


    //
    // Card Hero
    //

    .card-hero {
        max-height: 200px;
        min-height: 150px;
        position: relative;
        transition: min-height 300ms ease;
        transform: translate3d(0, 0, 0);
        min-width: 100%;
        overflow: hidden;
        z-index: 1;

        @include break(xs) {
            min-height: 200px;
        }

        @include break(lg) {
            min-height: 200px;
        }
    }


    //
    // Card Image
    //

    .card-image {
        background-color: $white;
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        height: inherit;
        min-height: inherit;
        min-width: 100%;
        opacity: 0.7;
        overflow: hidden;
        transition: opacity 250ms linear, transform 250ms linear, filter 250ms linear;
        z-index: -1;
        filter: grayscale(0.3);
    }

    .card-hero:hover .card-image {
        filter: grayscale(0);
        opacity: 1;
        transform: scale(1.2);
        object-fit: cover;
    }


    //
    // Card Token
    //

    .card-token {
        align-items: center;
        background-color: #3c8dbc;
        bottom: -25px;
        box-shadow: 0 1px 5px rgba(#000, 0.35);
        color: #fff;
        border-radius: 50%;
        font-size: 20px;
        height: 50px;
        justify-content: center;
        position: absolute;
        right: 1.5em;
        transition: box-shadow 200ms ease-in-out, bottom 300ms ease, height 300ms ease, width 300ms ease, font-size 300ms ease, right 300ms ease, transform 300ms ease;
        width: 50px;
        z-index: 2;

        @include break(xs) {
            bottom: -30px;
            font-size: 24px;
            height: 65px;
            right: 1.75em;
            width: 65px;
        }
    }

    .card-token:hover {
        box-shadow: 0px 15px 15px -5px rgba(0,0,0,0.4);
        transform: translate3d(0, -2px, 0);
    }

    .card-token a {
        padding: 1em;
    }


    //
    // Card Footer
    //

    .card-footer {
        padding: 30px 20px 20px 20px;

        @include break(xs) {
            padding: 30px;
        }
    }


    //
    // Card Title
    //

    .card-title {
        color: $heading-color;
        font-size: 2em;
        margin-top: 0.25em;
        margin-bottom: 0.25em;
    }


    //
    // Card Subtitle
    //

    .card-subtitle {
        color: $subheading-color;
        font-size: 1.25em;
        margin-bottom: .5em;
    }


    //
    // Card Meta
    //

    .card-meta {
        justify-content: flex-start;
        margin-top: .25em;
        margin-bottom: 1em;
        flex-wrap: wrap;
    }

    .card-meta li,
    .card-meta:hover li.is-overflow {
        margin-right: 1.5em;
        padding: 0.15em 0;
        height: auto;
        margin-top: auto;
        opacity: 1;
        visibility: visible;
    }

    .card-meta li.is-overflow {
        height: 1px;
        margin-top: -1px;
        opacity: 0;
        padding: 0;
        visibility: hidden;
    }

    .card-meta li,
    .card-meta:hover li.is-overflow,
    .card-meta li i,
    .card-meta li a {
        color: $meta-color;
        text-decoration: none;
        display: inline-flex;
        align-items: baseline;
        justify-content: center;
        transition: color 150ms ease-in-out;
    }

    .card-meta i {
        margin-right: .5em;
    }

    .card-meta li.is-overflow,
    .card-meta li {
        transition: margin 300ms, height 300ms, opacity 300ms, padding 300ms;
    }

    .card-meta li:hover > a,
    .card-meta li:hover > i {
        color: $text-color;
    }

    //
    // Card Text
    //

    .card-text {
        margin-top: 1em;
        flex: 1 1 auto;
    }

    .card:not(.bottomless) .card-text {
        @include lineLimiter($line-height: 1.4em, $line-count: 3, $bg-color: #fff);
    }


    //
    // Card Base
    //

    .card-base {
        align-items: baseline;
        justify-content: space-between;
        flex: 1 1 auto;
    }



    //
    // Card Tags
    //

    .card-tags,
    .card-actions {
        margin-top: 5%;
    }

    .card-tags {
        flex-wrap: wrap;
        justify-content: flex-start;
        width: auto;
    }

    .card-tags li,
    .card-tags:hover li.is-overflow {
        align-items: center;
        justify-content: center;
        height: auto;
        margin-top: auto;
        opacity: 1;
        padding: .5em 0;
        visibility: visible;
    }

    .card-tags li.is-overflow {
        height: 1px;
        margin-top: -1px;
        opacity: 0;
        padding: 0;
        visibility: hidden;
    }


    .card-tags li a,
    .card-tags li i {
        align-items: center;
        display: inline-flex;
        justify-content: center;
    }

    .card-tags li:first-child {
        margin-right: -0.5em;
    }

    .card-tags li:not(:first-child) {
        margin-left: 1em;
    }

    .card-tags li,
    .card-tags li a {
        color: $meta-color;
        transition: color 150ms ease-in-out;
    }

    .card-tags li.is-overflow,
    .card-tags li {
        transition: margin 300ms, height 300ms, opacity 300ms, padding 300ms;
    }

    .card-tags li a:hover {
        color: $text-color;
    }

    //
    // Card Actions
    //

    .card-actions {
        flex-shrink: 0;
        justify-content: flex-end;
        width: 100%;
    }

    .card-tags ~ .card-actions {
        width: auto;
        margin-left: 1.5em;
    }


    /* ====================
          Helper Classes
       ==================== */

    .bottomless {
        max-height: none;
    }

    .nowrap {
        white-space: nowrap;
    }

    .showcase {
        opacity: 1;
    }

    .has-more {
        position: relative;
    }

    .has-more::after {
        position: absolute;
        content: '...';
        display: inline-flex;
        opacity: 1;
        transition: opacity 300ms ease;
    }

    .card-tags:hover .has-more::after {
        opacity: 0;
    }
</style>