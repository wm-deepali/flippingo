<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThemeSeeder extends Seeder
{
    public function run()
    {
        $timestamp = time();

        $themes = [
            [
                'name' => 'Blue Denim',
                'description' => 'Dark blue body with white big fields.',
                'color' => '#212a3e',
                'css' => <<<'CSS'
body {
    background-color: #212a3e;
    padding: 20px;
    color: #7b8291;
}

/* Small devices (tablets, 768px and up) */
@media (min-width: 768px) {
    body {
        padding: 50px;
    }
}
strong {
    color: #FFFFFF;
}
h1 {
    font-family: "helvetica", "arial", "sans-serif";
    font-size: 28px;
    font-weight: 400;
    line-height: 1.4;
    color: #fff;
    margin: 0 0 5px;
}
p.description {
    color: #1ec185;
    background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAsAAAAPCAYAAAAyPTUwAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAA4JpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNS1jMDIxIDc5LjE1NTc3MiwgMjAxNC8wMS8xMy0xOTo0NDowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDpEQUIyQTJGOUZCNzZERTExQkFGNUUxNDNCMEI4NkZGMSIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDpFREYxQURBODk5N0YxMUU0OTU0N0EzNkVCREUxQzBFRCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDpFREYxQURBNzk5N0YxMUU0OTU0N0EzNkVCREUxQzBFRCIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ0MgMjAxNCAoTWFjaW50b3NoKSI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOmNlOWNlZGU1LTM1YTYtNDFiNi04NDA4LTM2YmIxMjY4NjdhNSIgc3RSZWY6ZG9jdW1lbnRJRD0iYWRvYmU6ZG9jaWQ6cGhvdG9zaG9wOmI2Nzk5MjljLWRmZTMtMTE3Ny1iOGNhLTlmM2YyOWFkM2Y1YiIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PoBOvTYAAACrSURBVHjaYpE72MqABKSA2B+IZYH4ERBvAOIXMEkWJIUhQLwIiDmRxHqBOBqqiYEJKiiJpvA/lOaCiosgK/ZFUhgIxKxAHAHl8wKxF7IzZJGs3gCl16L5BW4ystth4A+6AEgRIxBzIIkJYtHICVN8HIjNkSTeYVFcB8QOTGgK8QE7JgYSwCBS/JNItV9BQecJxD5ArAPEikDMB8RsUEM+A/E9IL4EilGAAAMAaCsYB5gwb+gAAAAASUVORK5CYII=") 0 40% no-repeat;
    font-size: 14px;
    padding-left: 20px;
    display: inline-block;
    margin: 5px auto 0;
}
.form-group {
    font-size: 14px;
    color: #7b8291;
    margin-top: 20px;
}
.form-label {
    font-size: 16px;
    color: #fff;
    margin: 0 5px 9px 0;
}
.required-control .form-label:after {
    color: #e55;
    margin-left: 5px;
}
.form-control, .form-select {
    background: #363e51;
    border-color: transparent;
    border-radius: 3px;
    color: #fff;
    margin: 0;
    min-height: 36px;
    width: 100%;
    -webkit-transition: background .08s linear;
    -moz-transition: background .08s linear;
    -o-transition: background .08s linear;
    transition: background .08s linear;
}
.form-control:hover {
    background: #424a5b
}
.form-control:focus {
    background: #fff;
    color: #212a3e
}
.form-control::-webkit-input-placeholder {
    color: #7b8291
}
.form-control::-moz-placeholder {
    color: #7b8291
}
.form-control:-ms-input-placeholder {
    color: #7b8291
}
.form-control::placeholder {
    color: #7b8291
}
.btn {
    border-radius: 4px;
    border: 0 !important;
    font-size: 18px;
    font-weight: 500;
    width: auto;
    height: 55px;
    line-height: 55px;
    margin: 0;
    padding: 0 30px;
    -webkit-transition: background-color .1s ease;
    -moz-transition: background-color .1s ease;
    -o-transition: background-color .1s ease;
    transition: background-color .1s ease;
}
.btn-primary {
    background-color: #1ec185;
}
.btn-primary:focus, .btn-primary:active, .btn-primary:hover {
    background-color: #1baf79 !important;
    color: #fff;
    border: 0 !important;
    outline: 0 none !important;
    box-shadow: none !important;
}
CSS
,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'Sky Blue',
                'description' => 'Blue sky background with clouds around. White form with a thin typography.',
                'color' => '#95D6FE',
                'css' => <<<'CSS'
@import url(https://fonts.googleapis.com/css?family=Roboto:400,300);
body {
    background-color: #95D6FE;
    overflow-x: hidden;
    padding: 20px;
    color: #A9A9A9;
    color: rgba(255, 255, 255, 0.6);
    font-family: Roboto, sans-serif;
}
/* Small devices (tablets, 768px and up) */
@media (min-width: 768px) {
    body {
        padding: 50px 25%;
    }
}
/**
 * Form
 */
h1 {
    color: #FFFFFF;
    font-size: 32px;
    font-weight: 300;
    text-align: center;
    margin: .3em 0;
    -webkit-animation: titleFadein .8s ease;
    -moz-animation: titleFadein .8s ease;
    animation: titleFadein .8s ease;
}
p:first-of-type {
    color: #FFFFFF;
    color: rgba(255, 255, 255, 0.92);
    font-weight: 300;
    font-size: 20px;
    text-shadow: none;
    text-align: center;
}
.form-group {
    background-color: #ffffff;
    font-size: 14px;
    padding: 40px 40px 0px;
    margin: 0;
}
.row>div {
    padding: 0;
}
.row div:first-of-type .form-group {
    padding-top: 40px;
    margin-top: 40px;
}
.form-action {
    margin: 0;
    padding: 40px 40px 40px 40px;
    background-color: #ffffff;
    font-size: 14px;
}
.form-label {
    font-weight: 300;
    font-size: 16px;
    color: #777777;
}
.form-control {
    width: 100%;
    height: 48px;
    -webkit-box-sizing: padding-box;
    -moz-box-sizing: padding-box;
    box-sizing: padding-box;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background-color: #EFEFEF;
    background-color: rgba(0, 0, 0, 0.03);
    border-color: transparent;
    border-radius: 6px;
    font-size: 20px;
    font-family: Roboto, sans-serif;
    font-weight: 300;
    box-shadow: inset 0px 2px 1px rgba(0, 0, 0, .03);
    outline: none;
    text-overflow: ellipsis;
    -webkit-font-smoothing: antialiased;
}
.form-control:focus {
    border-color: rgb(138, 197, 65);
    box-shadow: inset 0 0 0 0,inset 0 1px 2px rgba(138, 197, 65, 0.15),0 0 10px rgba(138, 197, 65, 0.8),0 2px 0 rgba(138, 197, 65,0.1);
    transition: none;
}
.form-control::-webkit-input-placeholder {
    color: #A9A9A9;
}
.form-control::-moz-placeholder {
    color: #A9A9A9;
}
.form-control:-ms-input-placeholder {
    color: #A9A9A9;
}
.form-control::placeholder {
    color: #A9A9A9;
}
.radio label, .checkbox label {
    color: #7C7C7C;
    font-weight: 300;
}
.btn {
    display: block;
    padding: 0 28px;
    border-radius: 28px;
    width: auto;
    height: 56px;
    margin: 0 auto;
    overflow: hidden;
    -webkit-font-smoothing: antialiased;
    font-size: 24px;
}
.btn-primary {
    background-color: rgb(138, 197, 65);
    background-color: rgba(138, 197, 65, 0.90);
    border-color: transparent;
}
.btn-primary:focus, .btn-primary:hover {
    background: rgb(138, 197, 65) !important;
    border-color: transparent !important;
    color: rgb(255, 255, 255) !important;
}
.info {
    font-size: 16px;
    color: rgb(102, 102, 102);
    color: rgba(102, 102, 102, 0.3);
    padding: 10px 40px;
    background-color: #ffffff;
    margin: 0;
}
/**
 * Clouds
 *
 * You must add this snippet to your form:
 *
 * <div id="clouds">
 *   <div class="cloud x1"></div>
 *   <div class="cloud x2"></div>
 *   <div class="cloud x3"></div>
 *   <div class="cloud x4"></div>
 *   <div class="cloud x5"></div>
 * </div>
 *
 * Based on [http://thecodeplayer.com/walkthrough/pure-css3-animated-clouds-background](http://thecodeplayer.com/walkthrough/pure-css3-animated-clouds-background)
 */
#clouds{
    top: 220px;
    padding: 100px 0;
    position: absolute;
    z-index: -1;
}
/*Time to finalise the cloud shape*/
.cloud {
    width: 200px; height: 60px;
    background: #fff;

    border-radius: 200px;
    -moz-border-radius: 200px;
    -webkit-border-radius: 200px;

    position: relative;
}
.cloud:before, .cloud:after {
    content: "";
    position: absolute;
    background: #fff;
    width: 100px; height: 80px;
    top: -15px; left: 10px;

    border-radius: 100px;
    -moz-border-radius: 100px;
    -webkit-border-radius: 100px;

    -webkit-transform: rotate(30deg);
    transform: rotate(30deg);
    -moz-transform: rotate(30deg);
}
.cloud:after {
    width: 120px; height: 120px;
    top: -55px; left: auto; right: 15px;
}
/*Time to animate*/
.x1 {
    -webkit-animation: moveclouds 15s linear infinite;
    -moz-animation: moveclouds 15s linear infinite;
    -o-animation: moveclouds 15s linear infinite;
}
/*variable speed, opacity, and position of clouds for realistic effect*/
.x2 {
    left: 200px;

    -webkit-transform: scale(0.6);
    -moz-transform: scale(0.6);
    transform: scale(0.6);
    opacity: 0.6; /*opacity proportional to the size*/

    /*Speed will also be proportional to the size and opacity*/
    /*More the speed. Less the time in "s" = seconds*/
    -webkit-animation: moveclouds 25s linear infinite;
    -moz-animation: moveclouds 25s linear infinite;
    -o-animation: moveclouds 25s linear infinite;
}
.x3 {
    left: -250px; top: -200px;

    -webkit-transform: scale(0.8);
    -moz-transform: scale(0.8);
    transform: scale(0.8);
    opacity: 0.8; /*opacity proportional to size*/

    -webkit-animation: moveclouds 20s linear infinite;
    -moz-animation: moveclouds 20s linear infinite;
    -o-animation: moveclouds 20s linear infinite;
}
.x4 {
    left: 470px; top: -250px;

    -webkit-transform: scale(0.75);
    -moz-transform: scale(0.75);
    transform: scale(0.75);
    opacity: 0.75; /*opacity proportional to size*/

    -webkit-animation: moveclouds 18s linear infinite;
    -moz-animation: moveclouds 18s linear infinite;
    -o-animation: moveclouds 18s linear infinite;
}
.x5 {
    left: -150px; top: -150px;

    -webkit-transform: scale(0.8);
    -moz-transform: scale(0.8);
    transform: scale(0.8);
    opacity: 0.8; /*opacity proportional to size*/

    -webkit-animation: moveclouds 20s linear infinite;
    -moz-animation: moveclouds 20s linear infinite;
    -o-animation: moveclouds 20s linear infinite;
}
@-webkit-keyframes moveclouds {
    0% {margin-left: 1600px;}
    100% {margin-left: -1600px;}
}
@-moz-keyframes moveclouds {
    0% {margin-left: 1600px;}
    100% {margin-left: -1600px;}
}
@-o-keyframes moveclouds {
    0% {margin-left: 1600px;}
    100% {margin-left: -1600px;}
}
CSS
,
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ];

        \DB::table('themes')->insert($themes);
    }
}
