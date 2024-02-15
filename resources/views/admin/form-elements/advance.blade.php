@extends('layouts.app')

@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <x-breadcrumb :breadcrumbs="$breadcrumbs" :page-title="$pageTitle"/>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Select2</h4>
                            <p class="text-muted font-14">Select2 gives you a customizable select box with support for searching, tagging, remote data sets, infinite scrolling, and many other highly used options.</p>

                            <ul class="nav nav-tabs nav-bordered mb-3">
                                <li class="nav-item">
                                    <a href="#select2-preview" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                        Preview
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#select2-code" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                        Code
                                    </a>
                                </li>
                            </ul> <!-- end nav-->
                            <div class="tab-content">
                                <div class="tab-pane show active" id="select2-preview">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <p class="mb-1 fw-bold text-muted">Single Select</p>
                                            <p class="text-muted font-14">
                                                Select2 can take a regular select box like this...
                                            </p>

                                            <select class="form-control select2" data-toggle="select2">
                                                <option>Select</option>
                                                <optgroup label="Alaskan/Hawaiian Time Zone">
                                                    <option value="AK">Alaska</option>
                                                    <option value="HI">Hawaii</option>
                                                </optgroup>
                                                <optgroup label="Pacific Time Zone">
                                                    <option value="CA">California</option>
                                                    <option value="NV">Nevada</option>
                                                    <option value="OR">Oregon</option>
                                                    <option value="WA">Washington</option>
                                                </optgroup>
                                                <optgroup label="Mountain Time Zone">
                                                    <option value="AZ">Arizona</option>
                                                    <option value="CO">Colorado</option>
                                                    <option value="ID">Idaho</option>
                                                    <option value="MT">Montana</option>
                                                    <option value="NE">Nebraska</option>
                                                    <option value="NM">New Mexico</option>
                                                    <option value="ND">North Dakota</option>
                                                    <option value="UT">Utah</option>
                                                    <option value="WY">Wyoming</option>
                                                </optgroup>
                                                <optgroup label="Central Time Zone">
                                                    <option value="AL">Alabama</option>
                                                    <option value="AR">Arkansas</option>
                                                    <option value="IL">Illinois</option>
                                                    <option value="IA">Iowa</option>
                                                    <option value="KS">Kansas</option>
                                                    <option value="KY">Kentucky</option>
                                                    <option value="LA">Louisiana</option>
                                                    <option value="MN">Minnesota</option>
                                                    <option value="MS">Mississippi</option>
                                                    <option value="MO">Missouri</option>
                                                    <option value="OK">Oklahoma</option>
                                                    <option value="SD">South Dakota</option>
                                                    <option value="TX">Texas</option>
                                                    <option value="TN">Tennessee</option>
                                                    <option value="WI">Wisconsin</option>
                                                </optgroup>
                                                <optgroup label="Eastern Time Zone">
                                                    <option value="CT">Connecticut</option>
                                                    <option value="DE">Delaware</option>
                                                    <option value="FL">Florida</option>
                                                    <option value="GA">Georgia</option>
                                                    <option value="IN">Indiana</option>
                                                    <option value="ME">Maine</option>
                                                    <option value="MD">Maryland</option>
                                                    <option value="MA">Massachusetts</option>
                                                    <option value="MI">Michigan</option>
                                                    <option value="NH">New Hampshire</option>
                                                    <option value="NJ">New Jersey</option>
                                                    <option value="NY">New York</option>
                                                    <option value="NC">North Carolina</option>
                                                    <option value="OH">Ohio</option>
                                                    <option value="PA">Pennsylvania</option>
                                                    <option value="RI">Rhode Island</option>
                                                    <option value="SC">South Carolina</option>
                                                    <option value="VT">Vermont</option>
                                                    <option value="VA">Virginia</option>
                                                    <option value="WV">West Virginia</option>
                                                </optgroup>
                                            </select>
                                        </div> <!-- end col -->

                                        <div class="col-lg-6">
                                            <p class="mb-1 fw-bold text-muted">Multiple Select</p>
                                            <p class="text-muted font-14">
                                                Select2 can take a regular select box like this...
                                            </p>

                                            <select class="select2 form-control select2-multiple" data-toggle="select2" multiple="multiple" data-placeholder="Choose ...">
                                                <optgroup label="Alaskan/Hawaiian Time Zone">
                                                    <option value="AK">Alaska</option>
                                                    <option value="HI">Hawaii</option>
                                                </optgroup>
                                                <optgroup label="Pacific Time Zone">
                                                    <option value="CA">California</option>
                                                    <option value="NV">Nevada</option>
                                                    <option value="OR">Oregon</option>
                                                    <option value="WA">Washington</option>
                                                </optgroup>
                                                <optgroup label="Mountain Time Zone">
                                                    <option value="AZ">Arizona</option>
                                                    <option value="CO">Colorado</option>
                                                    <option value="ID">Idaho</option>
                                                    <option value="MT">Montana</option>
                                                    <option value="NE">Nebraska</option>
                                                    <option value="NM">New Mexico</option>
                                                    <option value="ND">North Dakota</option>
                                                    <option value="UT">Utah</option>
                                                    <option value="WY">Wyoming</option>
                                                </optgroup>
                                                <optgroup label="Central Time Zone">
                                                    <option value="AL">Alabama</option>
                                                    <option value="AR">Arkansas</option>
                                                    <option value="IL">Illinois</option>
                                                    <option value="IA">Iowa</option>
                                                    <option value="KS">Kansas</option>
                                                    <option value="KY">Kentucky</option>
                                                    <option value="LA">Louisiana</option>
                                                    <option value="MN">Minnesota</option>
                                                    <option value="MS">Mississippi</option>
                                                    <option value="MO">Missouri</option>
                                                    <option value="OK">Oklahoma</option>
                                                    <option value="SD">South Dakota</option>
                                                    <option value="TX">Texas</option>
                                                    <option value="TN">Tennessee</option>
                                                    <option value="WI">Wisconsin</option>
                                                </optgroup>
                                                <optgroup label="Eastern Time Zone">
                                                    <option value="CT">Connecticut</option>
                                                    <option value="DE">Delaware</option>
                                                    <option value="FL">Florida</option>
                                                    <option value="GA">Georgia</option>
                                                    <option value="IN">Indiana</option>
                                                    <option value="ME">Maine</option>
                                                    <option value="MD">Maryland</option>
                                                    <option value="MA">Massachusetts</option>
                                                    <option value="MI">Michigan</option>
                                                    <option value="NH">New Hampshire</option>
                                                    <option value="NJ">New Jersey</option>
                                                    <option value="NY">New York</option>
                                                    <option value="NC">North Carolina</option>
                                                    <option value="OH">Ohio</option>
                                                    <option value="PA">Pennsylvania</option>
                                                    <option value="RI">Rhode Island</option>
                                                    <option value="SC">South Carolina</option>
                                                    <option value="VT">Vermont</option>
                                                    <option value="VA">Virginia</option>
                                                    <option value="WV">West Virginia</option>
                                                </optgroup>
                                            </select>
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->
                                </div> <!-- end preview-->

                                <div class="tab-pane code" id="select2-code">
                                    <button class="btn-copy-clipboard" data-clipboard-action="copy">Copy</button>
                                    <pre class="mb-0">
                                        <span class="html escape">
                                            &lt;!-- Select2 css --&gt;
                                            &lt;link href=&quot;assets/vendor/select2/css/select2.min.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot; /&gt;

                                            &lt;!--  Select2 Js --&gt;
                                            &lt;script src=&quot;assets/vendor/select2/js/select2.min.js&quot;&gt;&lt;/script&gt;

                                            &lt;!-- Single Select --&gt;
                                            &lt;select class=&quot;form-control select2&quot; data-toggle=&quot;select2&quot;&gt;
                                                &lt;option&gt;Select&lt;/option&gt;
                                                &lt;optgroup label=&quot;Alaskan/Hawaiian Time Zone&quot;&gt;
                                                    &lt;option value=&quot;AK&quot;&gt;Alaska&lt;/option&gt;
                                                    &lt;option value=&quot;HI&quot;&gt;Hawaii&lt;/option&gt;
                                                &lt;/optgroup&gt;
                                                &lt;optgroup label=&quot;Pacific Time Zone&quot;&gt;
                                                    &lt;option value=&quot;CA&quot;&gt;California&lt;/option&gt;
                                                    &lt;option value=&quot;NV&quot;&gt;Nevada&lt;/option&gt;
                                                    &lt;option value=&quot;OR&quot;&gt;Oregon&lt;/option&gt;
                                                    &lt;option value=&quot;WA&quot;&gt;Washington&lt;/option&gt;
                                                &lt;/optgroup&gt;
                                            &lt;/select&gt;

                                            &lt;!-- Multiple Select --&gt;
                                            &lt;select class=&quot;select2 form-control select2-multiple&quot; data-toggle=&quot;select2&quot; multiple=&quot;multiple&quot; data-placeholder=&quot;Choose ...&quot;&gt;
                                                &lt;optgroup label=&quot;Alaskan/Hawaiian Time Zone&quot;&gt;
                                                    &lt;option value=&quot;AK&quot;&gt;Alaska&lt;/option&gt;
                                                    &lt;option value=&quot;HI&quot;&gt;Hawaii&lt;/option&gt;
                                                &lt;/optgroup&gt;
                                                &lt;optgroup label=&quot;Pacific Time Zone&quot;&gt;
                                                    &lt;option value=&quot;CA&quot;&gt;California&lt;/option&gt;
                                                    &lt;option value=&quot;NV&quot;&gt;Nevada&lt;/option&gt;
                                                    &lt;option value=&quot;OR&quot;&gt;Oregon&lt;/option&gt;
                                                    &lt;option value=&quot;WA&quot;&gt;Washington&lt;/option&gt;
                                                &lt;/optgroup&gt;
                                                &lt;optgroup label=&quot;Mountain Time Zone&quot;&gt;
                                                    &lt;option value=&quot;AZ&quot;&gt;Arizona&lt;/option&gt;
                                                    &lt;option value=&quot;CO&quot;&gt;Colorado&lt;/option&gt;
                                                    &lt;option value=&quot;ID&quot;&gt;Idaho&lt;/option&gt;
                                                    &lt;option value=&quot;MT&quot;&gt;Montana&lt;/option&gt;
                                                    &lt;option value=&quot;NE&quot;&gt;Nebraska&lt;/option&gt;
                                                    &lt;option value=&quot;NM&quot;&gt;New Mexico&lt;/option&gt;
                                                    &lt;option value=&quot;ND&quot;&gt;North Dakota&lt;/option&gt;
                                                    &lt;option value=&quot;UT&quot;&gt;Utah&lt;/option&gt;
                                                    &lt;option value=&quot;WY&quot;&gt;Wyoming&lt;/option&gt;
                                                &lt;/optgroup&gt;
                                            &lt;/select&gt;
                                        </span>
                                    </pre> <!-- end highlight-->
                                </div> <!-- end preview code-->
                            </div> <!-- end tab-content-->

                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div>
            <!-- end row-->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Date Range Picker</h4>
                            <p class="text-muted font-14">
                                A JavaScript component for choosing date ranges, dates and times.
                            </p>

                            <ul class="nav nav-tabs nav-bordered mb-3">
                                <li class="nav-item">
                                    <a href="#daterange-picker-preview" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                        Preview
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#daterange-picker-code" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                        Code
                                    </a>
                                </li>
                            </ul> <!-- end nav-->
                            <div class="tab-content">
                                <div class="tab-pane show active" id="daterange-picker-preview">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <!-- Date Range -->
                                            <div class="mb-3">
                                                <label class="form-label">Date Range</label>
                                                <input type="text" class="form-control date" id="singledaterange" data-toggle="date-picker" data-cancel-class="btn-warning">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <!-- Date Range Picker With Times -->
                                            <div class="mb-3">
                                                <label class="form-label">Date Range Picker With Times</label>
                                                <input type="text" class="form-control date" id="daterangetime" data-toggle="date-picker" data-time-picker="true" data-locale="{'format': 'DD/MM hh:mm A'}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <!-- Single Date Picker -->
                                            <div>
                                                <label class="form-label">Single Date Picker</label>
                                                <input type="text" class="form-control date" id="birthdatepicker" data-toggle="date-picker" data-single-date-picker="true">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <!-- Predefined Date Ranges -->
                                            <div>
                                                <label class="form-label">Predefined Date Ranges</label>
                                                <div id="reportrange" class="form-control" data-toggle="date-picker-range" data-target-display="#selectedValue"  data-cancel-class="btn-light">
                                                    <i class="mdi mdi-calendar"></i>&nbsp;
                                                    <span id="selectedValue"></span> <i class="mdi mdi-menu-down"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end preview-->

                                <div class="tab-pane code" id="daterange-picker-code">
                                    <button class="btn-copy-clipboard" data-clipboard-action="copy">Copy</button>
                                    <pre class="mb-0">
                                        <span class="html escape">
                                            &lt;!-- Daterangepicker css --&gt;
                                            &lt;link rel=&quot;stylesheet&quot; href=&quot;assets/vendor/daterangepicker/daterangepicker.css&quot; type=&quot;text/css&quot; /&gt;

                                            &lt;!-- Daterangepicker js --&gt;
                                            &lt;script src=&quot;assets/vendor/daterangepicker/moment.min.js&quot;&gt;&lt;/script&gt;
                                            &lt;script src=&quot;assets/vendor/daterangepicker/daterangepicker.js&quot;&gt;&lt;/script&gt;

                                            &lt;!-- Date Range --&gt;
                                            &lt;div class=&quot;mb-3&quot;&gt;
                                                &lt;label class=&quot;form-label&quot;&gt;Date Range&lt;/label&gt;
                                                &lt;input type=&quot;text&quot; class=&quot;form-control date&quot; id=&quot;singledaterange&quot; data-toggle=&quot;date-picker&quot; data-cancel-class=&quot;btn-warning&quot;&gt;
                                            &lt;/div&gt;

                                            &lt;!-- Date Range Picker With Times --&gt;
                                            &lt;div class=&quot;mb-3&quot;&gt;
                                                &lt;label class=&quot;form-label&quot;&gt;Date Range Picker With Times&lt;/label&gt;
                                                &lt;input type=&quot;text&quot; class=&quot;form-control date&quot; id=&quot;daterangetime&quot; data-toggle=&quot;date-picker&quot; data-time-picker=&quot;true&quot; data-locale=&quot;{'format': 'DD/MM hh:mm A'}&quot;&gt;
                                            &lt;/div&gt;

                                            &lt;!-- Single Date Picker --&gt;
                                            &lt;div class=&quot;mb-3&quot;&gt;
                                                &lt;label class=&quot;form-label&quot;&gt;Single Date Picker&lt;/label&gt;
                                                &lt;input type=&quot;text&quot; class=&quot;form-control date&quot; id=&quot;birthdatepicker&quot; data-toggle=&quot;date-picker&quot; data-single-date-picker=&quot;true&quot;&gt;
                                            &lt;/div&gt;

                                            &lt;!-- Predefined Date Ranges --&gt;
                                            &lt;div class=&quot;mb-3&quot;&gt;
                                                &lt;label class=&quot;form-label&quot;&gt;Predefined Date Ranges&lt;/label&gt;
                                                &lt;div id=&quot;reportrange&quot; class=&quot;form-control&quot; data-toggle=&quot;date-picker-range&quot; data-target-display=&quot;#selectedValue&quot;  data-cancel-class=&quot;btn-light&quot;&gt;
                                                    &lt;i class=&quot;mdi mdi-calendar&quot;&gt;&lt;/i&gt;&amp;nbsp;
                                                    &lt;span id=&quot;selectedValue&quot;&gt;&lt;/span&gt; &lt;i class=&quot;mdi mdi-menu-down&quot;&gt;&lt;/i&gt;
                                                &lt;/div&gt;
                                            &lt;/div&gt;
                                        </span>
                                    </pre> <!-- end highlight-->
                                </div> <!-- end preview code-->
                            </div> <!-- end tab-content-->

                        </div> <!-- end card-body -->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Switch</h4>
                            <p class="text-muted font-14">
                                Here are a few types of switches.
                            </p>

                            <ul class="nav nav-tabs nav-bordered mb-4">
                                <li class="nav-item">
                                    <a href="#switches-preview" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                        Preview
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#switches-code" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                        Code
                                    </a>
                                </li>
                            </ul> <!-- end nav-->
                            <div class="tab-content">
                                <div class="tab-pane show active" id="switches-preview">
                                    <!-- without label-->
                                    <input type="checkbox" id="switch0" data-switch="none"/>
                                    <label for="switch0" data-on-label="" data-off-label=""></label>

                                    <!-- Bool Switch-->
                                    <input type="checkbox" id="switch1" checked data-switch="bool"/>
                                    <label for="switch1" data-on-label="On" data-off-label="Off"></label>

                                    <!-- Primary Switch-->
                                    <input type="checkbox" id="switch2" checked data-switch="primary"/>
                                    <label for="switch2" data-on-label="On" data-off-label="Off"></label>

                                    <!-- Success Switch-->
                                    <input type="checkbox" id="switch3" checked data-switch="success"/>
                                    <label for="switch3" data-on-label="Yes" data-off-label="No"></label>

                                    <!-- Info Switch-->
                                    <input type="checkbox" id="switch4" checked data-switch="info"/>
                                    <label for="switch4" data-on-label="On" data-off-label="Off"></label>

                                    <!-- Warning Switch-->
                                    <input type="checkbox" id="switch5" checked data-switch="warning"/>
                                    <label for="switch5" data-on-label="Yes" data-off-label="No"></label>

                                    <!-- Danger Switch-->
                                    <input type="checkbox" id="switch6" checked data-switch="danger"/>
                                    <label for="switch6" data-on-label="On" data-off-label="Off"></label>

                                    <!-- Dark Switch-->
                                    <input type="checkbox" id="switch7" checked data-switch="secondary"/>
                                    <label for="switch7" data-on-label="Yes" data-off-label="No"></label>

                                    <!-- Disbled Switch-->
                                    <input type="checkbox" id="switchdis" data-switch="primary" checked disabled/>
                                    <label for="switchdis" data-on-label="On" data-off-label="Off"></label>

                                </div> <!-- end preview-->

                                <div class="tab-pane code" id="switches-code">
                                    <button class="btn-copy-clipboard" data-clipboard-action="copy">Copy</button>
                                    <pre class="mb-0">
                                        <span class="html escape">
                                            &lt;!-- Without label--&gt;
                                            &lt;input type=&quot;checkbox&quot; id=&quot;switch0&quot; data-switch=&quot;none&quot;/&gt;
                                            &lt;label for=&quot;switch0&quot; data-on-label=&quot;&quot; data-off-label=&quot;&quot;&gt;&lt;/label&gt;

                                            &lt;!-- Bool Switch--&gt;
                                            &lt;input type=&quot;checkbox&quot; id=&quot;switch1&quot; checked data-switch=&quot;bool&quot;/&gt;
                                            &lt;label for=&quot;switch1&quot; data-on-label=&quot;On&quot; data-off-label=&quot;Off&quot;&gt;&lt;/label&gt;

                                            &lt;!-- Primary Switch--&gt;
                                            &lt;input type=&quot;checkbox&quot; id=&quot;switch2&quot; checked data-switch=&quot;primary&quot;/&gt;
                                            &lt;label for=&quot;switch2&quot; data-on-label=&quot;On&quot; data-off-label=&quot;Off&quot;&gt;&lt;/label&gt;

                                            &lt;!-- Success Switch--&gt;
                                            &lt;input type=&quot;checkbox&quot; id=&quot;switch3&quot; checked data-switch=&quot;success&quot;/&gt;
                                            &lt;label for=&quot;switch3&quot; data-on-label=&quot;Yes&quot; data-off-label=&quot;No&quot;&gt;&lt;/label&gt;

                                            &lt;!-- Info Switch--&gt;
                                            &lt;input type=&quot;checkbox&quot; id=&quot;switch4&quot; checked data-switch=&quot;info&quot;/&gt;
                                            &lt;label for=&quot;switch4&quot; data-on-label=&quot;On&quot; data-off-label=&quot;Off&quot;&gt;&lt;/label&gt;

                                            &lt;!-- Warning Switch--&gt;
                                            &lt;input type=&quot;checkbox&quot; id=&quot;switch5&quot; checked data-switch=&quot;warning&quot;/&gt;
                                            &lt;label for=&quot;switch5&quot; data-on-label=&quot;Yes&quot; data-off-label=&quot;No&quot;&gt;&lt;/label&gt;

                                            &lt;!-- Danger Switch--&gt;
                                            &lt;input type=&quot;checkbox&quot; id=&quot;switch6&quot; checked data-switch=&quot;danger&quot;/&gt;
                                            &lt;label for=&quot;switch6&quot; data-on-label=&quot;On&quot; data-off-label=&quot;Off&quot;&gt;&lt;/label&gt;

                                            &lt;!-- Dark Switch--&gt;
                                            &lt;input type=&quot;checkbox&quot; id=&quot;switch7&quot; checked data-switch=&quot;secondary&quot;/&gt;
                                            &lt;label for=&quot;switch7&quot; data-on-label=&quot;Yes&quot; data-off-label=&quot;No&quot;&gt;&lt;/label&gt;

                                            &lt;!-- Disbled Switch--&gt;
                                            &lt;input type=&quot;checkbox&quot; id=&quot;switchdis&quot; data-switch=&quot;primary&quot; checked disabled/&gt;
                                            &lt;label for=&quot;switchdis&quot; data-on-label=&quot;On&quot; data-off-label=&quot;Off&quot;&gt;&lt;/label&gt;
                                        </span>
                                    </pre> <!-- end highlight-->
                                </div> <!-- end preview code-->
                            </div> <!-- end tab-content-->

                        </div> <!-- end card-body -->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Bootstrap Datepicker</h4>
                            <p class="text-muted font-14">
                                Bootstrap-datepicker provides a flexible datepicker widget in the Bootstrap style.
                            </p>

                            <ul class="nav nav-tabs nav-bordered mb-3">
                                <li class="nav-item">
                                    <a href="#datepicker-preview" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                        Preview
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#datepicker-code" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                        Code
                                    </a>
                                </li>
                            </ul> <!-- end nav-->
                            <div class="tab-content">
                                <div class="tab-pane show active" id="datepicker-preview">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3 position-relative" id="datepicker1">
                                                <label class="form-label">Date Picker</label>
                                                <input type="text" class="form-control" data-provide="datepicker" data-date-today-highlight="true" data-date-container="#datepicker1">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3 position-relative" id="datepicker2">
                                                <label class="form-label">Date View</label>
                                                <input type="text" class="form-control" data-provide="datepicker" data-date-format="d-M-yyyy" data-date-container="#datepicker2">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3 position-relative" id="datepicker3">
                                                <label class="form-label">Multi Datepicker</label>
                                                <input type="text" class="form-control" data-provide="datepicker" data-date-multidate="true" data-date-container="#datepicker3">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3 position-relative" id="datepicker4">
                                                <label class="form-label">Autoclose</label>
                                                <input type="text" class="form-control" data-provide="datepicker" data-date-autoclose="true" data-date-container="#datepicker4">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3 position-relative" id="datepicker5">
                                                <label class="form-label">Month View</label>
                                                <input type="text" class="form-control" data-provide="datepicker" data-date-format="MM yyyy" data-date-min-view-mode="1" data-date-container="#datepicker5">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3 position-relative" id="datepicker6">
                                                <label class="form-label">Year View</label>
                                                <input type="text" class="form-control" data-provide="datepicker" data-date-min-view-mode="2" data-date-container="#datepicker6">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div>
                                                <label class="form-label">Inline Datepicker</label>
                                                <div data-provide="datepicker-inline"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end preview-->

                                <div class="tab-pane code" id="datepicker-code">
                                    <button class="btn-copy-clipboard" data-clipboard-action="copy">Copy</button>
                                    <pre class="mb-0">
                                        <span class="html escape">
                                            &lt;!-- Bootstrap Datepicker css --&gt;
                                            &lt;link href=&quot;assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot; /&gt;

                                            &lt;!-- Bootstrap Datepicker js --&gt;
                                            &lt;script src=&quot;assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js&quot;&gt;&lt;/script&gt;

                                            &lt;!-- Date Picker --&gt;
                                            &lt;div class=&quot;mb-3 position-relative&quot; id=&quot;datepicker1&quot;&gt;
                                                &lt;label class=&quot;form-label&quot;&gt;Date Picker&lt;/label&gt;
                                                &lt;input type=&quot;text&quot; class=&quot;form-control&quot; data-provide=&quot;datepicker&quot; data-date-container=&quot;#datepicker1&quot;&gt;
                                            &lt;/div&gt;

                                            &lt;!-- Date View --&gt;
                                            &lt;div class=&quot;mb-3 position-relative&quot; id=&quot;datepicker2&quot;&gt;
                                                &lt;label class=&quot;form-label&quot;&gt;Date View&lt;/label&gt;
                                                &lt;input type=&quot;text&quot; class=&quot;form-control&quot; data-provide=&quot;datepicker&quot; data-date-format=&quot;d-M-yyyy&quot; data-date-container=&quot;#datepicker2&quot;&gt;
                                            &lt;/div&gt;

                                            &lt;!-- Multi Datepicker --&gt;
                                            &lt;div class=&quot;mb-3 position-relative&quot; id=&quot;datepicker3&quot;&gt;
                                                &lt;label class=&quot;form-label&quot;&gt;Multi Datepicker&lt;/label&gt;
                                                &lt;input type=&quot;text&quot; class=&quot;form-control&quot; data-provide=&quot;datepicker&quot; data-date-multidate=&quot;true&quot; data-date-container=&quot;#datepicker3&quot;&gt;
                                            &lt;/div&gt;

                                            &lt;!-- Autoclose --&gt;
                                            &lt;div class=&quot;mb-3 position-relative&quot; id=&quot;datepicker4&quot;&gt;
                                                &lt;label class=&quot;form-label&quot;&gt;Autoclose&lt;/label&gt;
                                                &lt;input type=&quot;text&quot; class=&quot;form-control&quot; data-provide=&quot;datepicker&quot; data-date-autoclose=&quot;true&quot; data-date-container=&quot;#datepicker4&quot;&gt;
                                            &lt;/div&gt;

                                            &lt;!-- Month View --&gt;
                                            &lt;div class=&quot;mb-3 position-relative&quot; id=&quot;datepicker5&quot;&gt;
                                                &lt;label class=&quot;form-label&quot;&gt;Month View&lt;/label&gt;
                                                &lt;input type=&quot;text&quot; class=&quot;form-control&quot; data-provide=&quot;datepicker&quot; data-date-format=&quot;MM yyyy&quot; data-date-min-view-mode=&quot;1&quot; data-date-container=&quot;#datepicker5&quot;&gt;
                                            &lt;/div&gt;

                                            &lt;!-- Year View --&gt;
                                            &lt;div class=&quot;mb-3 position-relative&quot; id=&quot;datepicker6&quot;&gt;
                                                &lt;label class=&quot;form-label&quot;&gt;Year View&lt;/label&gt;
                                                &lt;input type=&quot;text&quot; class=&quot;form-control&quot; data-provide=&quot;datepicker&quot; data-date-min-view-mode=&quot;2&quot; data-date-container=&quot;#datepicker6&quot;&gt;
                                            &lt;/div&gt;

                                            &lt;!-- Inline Datepicker --&gt;
                                            &lt;div class=&quot;mb-3&quot;&gt;
                                                &lt;label class=&quot;form-label&quot;&gt;Inline Datepicker&lt;/label&gt;
                                                &lt;div data-provide=&quot;datepicker-inline&quot;&gt;&lt;/div&gt;
                                            &lt;/div&gt;
                                        </span>
                                    </pre> <!-- end highlight-->
                                </div> <!-- end preview code-->
                            </div> <!-- end tab-content-->

                        </div> <!-- end card-body -->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Flatpickr - Date picker</h4>
                            <p class="text-muted font-14">A lightweight and powerful datetimepicker</p>

                            <ul class="nav nav-tabs nav-bordered mb-3">
                                <li class="nav-item">
                                    <a href="#flatpickr-datepicker-preview" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                        Preview
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#flatpickr-datepicker-code" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                        Code
                                    </a>
                                </li>
                            </ul> <!-- end nav-->
                            <div class="tab-content">
                                <div class="tab-pane show active" id="flatpickr-datepicker-preview">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Basic</label>
                                                <input type="text" id="basic-datepicker" class="form-control" placeholder="Basic datepicker">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Date & Time</label>
                                                <input type="text" id="datetime-datepicker" class="form-control" placeholder="Date and Time">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Human-friendly Dates</label>
                                                <input type="text" id="humanfd-datepicker" class="form-control" placeholder="October 9, 2018">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">MinDate and MaxDate</label>
                                                <input type="text" id="minmax-datepicker" class="form-control" placeholder="mindate - maxdate">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Disabling dates</label>
                                                <input type="text" id="disable-datepicker" class="form-control" placeholder="Disabling dates">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Selecting multiple dates</label>
                                                <input type="text" id="multiple-datepicker" class="form-control" placeholder="Multiple dates">
                                            </div>

                                        </div> <!-- end col -->

                                        <div class="col-lg-6 mt-3 mt-lg-0">
                                            <div class="mb-3">
                                                <label class="form-label">Selecting multiple dates - Conjunction</label>
                                                <input type="text" id="conjunction-datepicker" class="form-control" placeholder="2018-10-10 :: 2018-10-11">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Range Calendar</label>
                                                <input type="text" id="range-datepicker" class="form-control" placeholder="2018-10-03 to 2018-10-10">
                                            </div>

                                            <div>
                                                <label class="form-label">Inline Calendar</label>
                                                <input type="text" id="inline-datepicker" class="form-control" placeholder="Inline calendar">
                                            </div>
                                        </div> <!-- end col -->
                                    </div>
                                    <!-- end row -->
                                </div> <!-- end preview-->

                                <div class="tab-pane code" id="flatpickr-datepicker-code">
                                    <button class="btn-copy-clipboard" data-clipboard-action="copy">Copy</button>
                                    <pre class="mb-0">
                                        <span class="html escape">
                                            &lt;div class=&quot;mb-3&quot;&gt;
                                                &lt;label class=&quot;form-label&quot;&gt;Basic&lt;/label&gt;
                                                &lt;input type=&quot;text&quot; id=&quot;basic-datepicker&quot; class=&quot;form-control&quot; placeholder=&quot;Basic datepicker&quot;&gt;
                                            &lt;/div&gt;

                                            &lt;div class=&quot;mb-3&quot;&gt;
                                                &lt;label class=&quot;form-label&quot;&gt;Date &amp; Time&lt;/label&gt;
                                                &lt;input type=&quot;text&quot; id=&quot;datetime-datepicker&quot; class=&quot;form-control&quot; placeholder=&quot;Date and Time&quot;&gt;
                                            &lt;/div&gt;

                                            &lt;div class=&quot;mb-3&quot;&gt;
                                                &lt;label class=&quot;form-label&quot;&gt;Human-friendly Dates&lt;/label&gt;
                                                &lt;input type=&quot;text&quot; id=&quot;humanfd-datepicker&quot; class=&quot;form-control&quot; placeholder=&quot;October 9, 2018&quot;&gt;
                                            &lt;/div&gt;

                                            &lt;div class=&quot;mb-3&quot;&gt;
                                                &lt;label class=&quot;form-label&quot;&gt;MinDate and MaxDate&lt;/label&gt;
                                                &lt;input type=&quot;text&quot; id=&quot;minmax-datepicker&quot; class=&quot;form-control&quot; placeholder=&quot;mindate - maxdate&quot;&gt;
                                            &lt;/div&gt;

                                            &lt;div class=&quot;mb-3&quot;&gt;
                                                &lt;label class=&quot;form-label&quot;&gt;Disabling dates&lt;/label&gt;
                                                &lt;input type=&quot;text&quot; id=&quot;disable-datepicker&quot; class=&quot;form-control&quot; placeholder=&quot;Disabling dates&quot;&gt;
                                            &lt;/div&gt;

                                            &lt;div class=&quot;mb-3&quot;&gt;
                                                &lt;label class=&quot;form-label&quot;&gt;Selecting multiple dates&lt;/label&gt;
                                                &lt;input type=&quot;text&quot; id=&quot;multiple-datepicker&quot; class=&quot;form-control&quot; placeholder=&quot;Multiple dates&quot;&gt;
                                            &lt;/div&gt;

                                            &lt;div class=&quot;mb-3&quot;&gt;
                                                &lt;label class=&quot;form-label&quot;&gt;Selecting multiple dates - Conjunction&lt;/label&gt;
                                                &lt;input type=&quot;text&quot; id=&quot;conjunction-datepicker&quot; class=&quot;form-control&quot; placeholder=&quot;2018-10-10 :: 2018-10-11&quot;&gt;
                                            &lt;/div&gt;

                                            &lt;div class=&quot;mb-3&quot;&gt;
                                                &lt;label class=&quot;form-label&quot;&gt;Range Calendar&lt;/label&gt;
                                                &lt;input type=&quot;text&quot; id=&quot;range-datepicker&quot; class=&quot;form-control&quot; placeholder=&quot;2018-10-03 to 2018-10-10&quot;&gt;
                                            &lt;/div&gt;

                                            &lt;div&gt;
                                                &lt;label class=&quot;form-label&quot;&gt;Inline Calendar&lt;/label&gt;
                                                &lt;input type=&quot;text&quot; id=&quot;inline-datepicker&quot; class=&quot;form-control&quot; placeholder=&quot;Inline calendar&quot;&gt;
                                            &lt;/div&gt;
                                        </span>
                                    </pre> <!-- end highlight-->
                                </div> <!-- end preview code-->
                            </div> <!-- end tab-content-->
                        </div> <!-- end card-body -->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!-- end row -->


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Flatpickr - Time Picker </h4>
                            <p class="text-muted font-14">A lightweight and powerful datetimepicker</p>

                            <ul class="nav nav-tabs nav-bordered mb-3">
                                <li class="nav-item">
                                    <a href="#timepicker-flatpickr-preview" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                        Preview
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#timepicker-flatpickr-code" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                        Code
                                    </a>
                                </li>
                            </ul> <!-- end nav-->
                            <div class="tab-content">
                                <div class="tab-pane show active" id="timepicker-flatpickr-preview">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Default Time Picker</label>
                                                <div class="input-group">
                                                    <input id="basic-timepicker" type="text" class="form-control" placeholder="Basic timepicker">
                                                    <span class="input-group-text"><i class="ri-time-line"></i></span>
                                                </div>
                                            </div>

                                            <div class="mb-0">
                                                <label class="form-label">24-hour Time Picker</label>
                                                <div class="input-group">
                                                    <input id="24hours-timepicker" type="text" class="form-control" placeholder="16:21">
                                                    <span class="input-group-text"><i class="ri-time-line"></i></span>
                                                </div>
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-lg-6 mt-3 mt-lg-0">
                                            <div class="mb-3">
                                                <label class="form-label">Time Picker w/ Limits</label>
                                                <div class="input-group">
                                                    <input id="minmax-timepicker" type="text" class="form-control" placeholder="Limits">
                                                    <span class="input-group-text"><i class="ri-time-line"></i></span>
                                                </div>
                                            </div>

                                            <div class="mb-0">
                                                <label class="form-label">Preloading Time</label>
                                                <div class="input-group">
                                                    <input id="preloading-timepicker" type="text" class="form-control" placeholder="Pick a time">
                                                    <span class="input-group-text"><i class="ri-time-line"></i></span>
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                    </div>
                                    <!-- end row -->
                                </div> <!-- end preview-->

                                <div class="tab-pane code" id="timepicker-flatpickr-code">
                                    <button class="btn-copy-clipboard" data-clipboard-action="copy">Copy</button>
                                    <pre class="mb-0">
                                        <span class="html escape">
                                            &lt;div class=&quot;mb-3&quot;&gt;
                                                &lt;label class=&quot;form-label&quot;&gt;Default Time Picker&lt;/label&gt;
                                                &lt;div class=&quot;input-group&quot;&gt;
                                                    &lt;input id=&quot;basic-timepicker&quot; type=&quot;text&quot; class=&quot;form-control&quot; placeholder=&quot;Basic timepicker&quot;&gt;
                                                    &lt;span class=&quot;input-group-text&quot;&gt;&lt;i class=&quot;ri-time-line&quot;&gt;&lt;/i&gt;&lt;/span&gt;
                                                &lt;/div&gt;
                                            &lt;/div&gt;

                                            &lt;div class=&quot;mb-0&quot;&gt;
                                                &lt;label class=&quot;form-label&quot;&gt;24-hour Time Picker&lt;/label&gt;
                                                &lt;div class=&quot;input-group&quot;&gt;
                                                    &lt;input id=&quot;24hours-timepicker&quot; type=&quot;text&quot; class=&quot;form-control&quot; placeholder=&quot;16:21&quot;&gt;
                                                    &lt;span class=&quot;input-group-text&quot;&gt;&lt;i class=&quot;ri-time-line&quot;&gt;&lt;/i&gt;&lt;/span&gt;
                                                &lt;/div&gt;
                                            &lt;/div&gt;

                                            &lt;div class=&quot;mb-3&quot;&gt;
                                                &lt;label class=&quot;form-label&quot;&gt;Time Picker w/ Limits&lt;/label&gt;
                                                &lt;div class=&quot;input-group&quot;&gt;
                                                    &lt;input id=&quot;minmax-timepicker&quot; type=&quot;text&quot; class=&quot;form-control&quot; placeholder=&quot;Limits&quot;&gt;
                                                    &lt;span class=&quot;input-group-text&quot;&gt;&lt;i class=&quot;ri-time-line&quot;&gt;&lt;/i&gt;&lt;/span&gt;
                                                &lt;/div&gt;
                                            &lt;/div&gt;

                                            &lt;div class=&quot;mb-0&quot;&gt;
                                                &lt;label class=&quot;form-label&quot;&gt;Preloading Time&lt;/label&gt;
                                                &lt;div class=&quot;input-group&quot;&gt;
                                                    &lt;input id=&quot;preloading-timepicker&quot; type=&quot;text&quot; class=&quot;form-control&quot; placeholder=&quot;Pick a time&quot;&gt;
                                                    &lt;span class=&quot;input-group-text&quot;&gt;&lt;i class=&quot;ri-time-line&quot;&gt;&lt;/i&gt;&lt;/span&gt;
                                                &lt;/div&gt;
                                            &lt;/div&gt;
                                        </span>
                                    </pre> <!-- end highlight-->
                                </div> <!-- end preview code-->
                            </div> <!-- end tab-content-->

                        </div> <!-- end card-body -->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!-- end row -->


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Timepicker</h4>
                            <p class="text-muted font-14">
                                Easily select a time for a text input using your mouse or keyboards arrow keys. Specify attribute <code>data-toggle="timepicker"</code>
                                and you would have nice timepicker input element.
                            </p>

                            <ul class="nav nav-tabs nav-bordered mb-3">
                                <li class="nav-item">
                                    <a href="#timepicker-preview" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                        Preview
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#timepicker-code" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                        Code
                                    </a>
                                </li>
                            </ul> <!-- end nav-->
                            <div class="tab-content">
                                <div class="tab-pane show active" id="timepicker-preview">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Default Time Picker</label>
                                                <div class="input-group" id="timepicker-input-group1">
                                                    <input id="timepicker" type="text" class="form-control" data-provide="timepicker">
                                                    <span class="input-group-text"><i class="ri-time-line"></i></span>
                                                </div>
                                            </div>

                                            <div class="mb-0">
                                                <label class="form-label">24 Hour Mode Time Picker E.g. <code>data-show-meridian="false"</code></label>
                                                <div class="input-group" id="timepicker-input-group2">
                                                    <input id="timepicker2" type="text" class="form-control" data-provide='timepicker' data-show-meridian="false" >
                                                    <span class="input-group-text"><i class="ri-time-line"></i></span>
                                                </div>
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-lg-6 mt-3 mt-lg-0">
                                            <div class="mb-0">
                                                <label class="form-label">Specify a step for the minute field E.g. <code>data-minute-step="5"</code></label>
                                                <div class="input-group" id="timepicker-input-group3">
                                                    <input id="timepicker3" type="text" class="form-control" data-provide='timepicker' data-minute-step="5">
                                                    <span class="input-group-text"><i class="ri-time-line"></i></span>
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                    </div>
                                    <!-- end row -->
                                </div> <!-- end preview-->

                                <div class="tab-pane code" id="timepicker-code">
                                    <button class="btn-copy-clipboard" data-clipboard-action="copy">Copy</button>
                                    <pre class="mb-0">
                                        <span class="html escape">
                                            &lt;!-- Bootstrap Timepicker css --&gt;
                                            &lt;link href=&quot;assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.min.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot; /&gt;

                                            &lt;!-- Bootstrap Timepicker js --&gt;
                                            &lt;script src=&quot;assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.min.js&quot;&gt;&lt;/script&gt;
                                        </span>
                                    </pre> <!-- end highlight-->
                                    <button class="btn-copy-clipboard" data-clipboard-action="copy">Copy</button>
                                    <pre class="mb-0">
                                        <span class="html escape">
                                            &lt;div class=&quot;mb-3&quot;&gt;
                                                &lt;label class=&quot;form-label&quot;&gt;Default Time Picker&lt;/label&gt;
                                                &lt;div class=&quot;input-group&quot; id=&quot;timepicker-input-group1&quot;&gt;
                                                    &lt;input id=&quot;timepicker&quot; type=&quot;text&quot; class=&quot;form-control&quot; data-provide=&quot;timepicker&quot;&gt;
                                                    &lt;span class=&quot;input-group-text&quot;&gt;&lt;i class=&quot;ri-time-line&quot;&gt;&lt;/i&gt;&lt;/span&gt;
                                                &lt;/div&gt;
                                            &lt;/div&gt;

                                            &lt;div class=&quot;mb-0&quot;&gt;
                                                &lt;label class=&quot;form-label&quot;&gt;24 Hour Mode Time Picker E.g. &lt;code&gt;data-show-meridian=&quot;false&quot;&lt;/code&gt;&lt;/label&gt;
                                                &lt;div class=&quot;input-group&quot; id=&quot;timepicker-input-group2&quot;&gt;
                                                    &lt;input id=&quot;timepicker2&quot; type=&quot;text&quot; class=&quot;form-control&quot; data-provide='timepicker' data-show-meridian=&quot;false&quot; &gt;
                                                    &lt;span class=&quot;input-group-text&quot;&gt;&lt;i class=&quot;ri-time-line&quot;&gt;&lt;/i&gt;&lt;/span&gt;
                                                &lt;/div&gt;
                                            &lt;/div&gt;

                                            &lt;div class=&quot;mb-0&quot;&gt;
                                                &lt;label class=&quot;form-label&quot;&gt;Specify a step for the minute field E.g. &lt;code&gt;data-minute-step=&quot;5&quot;&lt;/code&gt;&lt;/label&gt;
                                                &lt;div class=&quot;input-group&quot; id=&quot;timepicker-input-group3&quot;&gt;
                                                    &lt;input id=&quot;timepicker3&quot; type=&quot;text&quot; class=&quot;form-control&quot; data-provide='timepicker' data-minute-step=&quot;5&quot;&gt;
                                                    &lt;span class=&quot;input-group-text&quot;&gt;&lt;i class=&quot;ri-time-line&quot;&gt;&lt;/i&gt;&lt;/span&gt;
                                                &lt;/div&gt;
                                            &lt;/div&gt;
                                        </span>
                                    </pre> <!-- end highlight-->
                                </div> <!-- end preview code-->
                            </div> <!-- end tab-content-->

                        </div> <!-- end card-body -->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!-- end row -->


        </div> <!-- container -->
    </div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('.select2').select2();
    });
</script>
@endsection
