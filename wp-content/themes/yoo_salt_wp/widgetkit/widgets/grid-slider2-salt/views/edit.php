<div class="uk-grid uk-grid-divider uk-form uk-form-horizontal" data-uk-grid-margin>
    <div class="uk-width-medium-1-4">

        <div class="wk-panel-marginless">
            <ul class="uk-nav uk-nav-side" data-uk-switcher="{connect:'#nav-content'}">
                <li><a href="">{{'Layout' | trans}}</a></li>
                <li><a href="">{{'Media' | trans}}</a></li>
                <li><a href="">Slideshow</a></li>
                <li><a href="">{{'Content' | trans}}</a></li>
                <li><a href="">{{'General' | trans}}</a></li>
            </ul>
        </div>

    </div>
    <div class="uk-width-medium-3-4">

        <ul id="nav-content" class="uk-switcher">
            <li>

                <h3 class="wk-form-heading">{{'Grid' | trans}}</h3>

                <div class="uk-form-row">
                    <label class="uk-form-label" for="wk-grid">{{'Behavior' | trans}}</label>
                    <div class="uk-form-controls">
                        <select id="wk-grid" class="uk-form-width-medium" ng-model="widget.data['grid']">
                            <option value="default">{{'Match Height' | trans}}</option>
                            <option value="dynamic">{{'Dynamic Grid' | trans}}</option>
                        </select>
                        <p class="uk-form-controls-condensed" ng-if="widget.data.grid == 'default'">
                            <label>
                                <select class="uk-form-width-small" ng-model="widget.data['gutter']">
                                    <option value="default">{{'Default' | trans}}</option>
                                    <option value="collapse">{{'Collapse' | trans}}</option>
                                    <option value="small">{{'Small' | trans}}</option>
                                </select>
                                {{'Gutter' | trans}}
                            </label>
                        </p>
                        <p class="uk-form-controls-condensed" ng-if="widget.data.grid == 'dynamic'">
                            <label>
                                <input class="uk-form-width-mini" type="text" ng-model="widget.data['gutter_dynamic']"> {{'Gutter (px)' | trans}}
                            </label>
                        </p>
                        <p class="uk-form-controls-condensed" ng-if="widget.data.grid == 'dynamic'">
                            <label>
                                <select class="uk-form-width-small" ng-model="widget.data['filter']">
                                    <option value="none">{{'None' | trans}}</option>
                                    <option value="text">{{'Text' | trans}}</option>
                                    <option value="lines">{{'Divider' | trans}}</option>
                                    <option value="nav">{{'Nav' | trans}}</option>
                                    <option value="tabs">{{'Tabs' | trans}}</option>
                                </select>
                                {{'Filter' | trans}}
                            </label>
                        </p>
                        <p class="uk-form-controls-condensed" ng-if="widget.data.grid == 'dynamic' && widget.data.filter != 'none'">
                            <label>
                                <select class="uk-form-width-small" ng-model="widget.data['filter_align']">
                                    <option value="left">{{'Left' | trans}}</option>
                                    <option value="center">{{'Center' | trans}}</option>
                                    <option value="right">{{'Right' | trans}}</option>
                                </select>
                                {{'Alignment' | trans}}
                            </label>
                        </p>

                        <p class="uk-form-controls-condensed">
                            <label><input type="checkbox" ng-model="widget.data['first_double']"> {{'Double Width on first Item.' | trans}}</label>
                        </p>
                    </div>
                </div>

                <h3 class="wk-form-heading">{{'Items' | trans}}</h3>

                <div class="uk-form-row">
                    <label class="uk-form-label" for="wk-panel">{{'Panel' | trans}}</label>
                    <div class="uk-form-controls">
                        <select id="wk-panel" class="uk-form-width-medium" ng-model="widget.data['panel0']">
                            <option value="box">{{'Box' | trans}}</option>
                            <option value="primary">{{'Box Primary' | trans}}</option>
                            <option value="secondary">{{'Box Secondary' | trans}}</option>
                            <option value="space">{{'Space' | trans}}</option>
                        </select>
                    </div>
                </div>

                 <div class="uk-form-row">
                    <label class="uk-form-label" for="wk-panel-2">{{'Panel 2' | trans}}</label>
                    <div class="uk-form-controls">
                        <select id="wk-panel-2" class="uk-form-width-medium" ng-model="widget.data['panel1']">
                            <option value="box">{{'Box' | trans}}</option>
                            <option value="primary">{{'Box Primary' | trans}}</option>
                            <option value="secondary">{{'Box Secondary' | trans}}</option>
                            <option value="space">{{'Space' | trans}}</option>
                        </select>
                    </div>
                </div>

                <div class="uk-form-row">
                    <label class="uk-form-label" for="wk-panel-3">{{'Panel 3' | trans}}</label>
                    <div class="uk-form-controls">
                        <select id="wk-panel-3" class="uk-form-width-medium" ng-model="widget.data['panel2']">
                            <option value="box">{{'Box' | trans}}</option>
                            <option value="primary">{{'Box Primary' | trans}}</option>
                            <option value="secondary">{{'Box Secondary' | trans}}</option>
                            <option value="space">{{'Space' | trans}}</option>
                        </select>
                    </div>
                </div>

                <div class="uk-form-row">
                    <label class="uk-form-label" for="wk-panel-4">{{'Panel 4' | trans}}</label>
                    <div class="uk-form-controls">
                        <select id="wk-panel-4" class="uk-form-width-medium" ng-model="widget.data['panel3']">
                            <option value="box">{{'Box' | trans}}</option>
                            <option value="primary">{{'Box Primary' | trans}}</option>
                            <option value="secondary">{{'Box Secondary' | trans}}</option>
                            <option value="space">{{'Space' | trans}}</option>
                        </select>
                    </div>
                </div>

                <div class="uk-form-row">
                    <label class="uk-form-label" for="wk-animation">{{'Animation' | trans}}</label>
                    <div class="uk-form-controls">
                        <select id="wk-animation" class="uk-form-width-medium" ng-model="widget.data['animation']">
                            <option value="none">{{'None' | trans}}</option>
                            <option value="fade">{{'Fade' | trans}}</option>
                            <option value="scale-up">{{'Scale Up' | trans}}</option>
                            <option value="scale-down">{{'Scale Down' | trans}}</option>
                            <option value="slide-top">{{'Slide Top' | trans}}</option>
                            <option value="slide-bottom">{{'Slide Bottom' | trans}}</option>
                            <option value="slide-left">{{'Slide Left' | trans}}</option>
                            <option value="slide-right">{{'Slide Right' | trans}}</option>
                        </select>
                    </div>
                </div>

            </li>
            <li>

                <h3 class="wk-form-heading">{{'Media' | trans}}</h3>

                <div class="uk-form-row">
                    <label class="uk-form-label" for="wk-media_align">{{'Media Align' | trans}}</label>
                    <div class="uk-form-controls">
                        <select id="wk_media_align" class="uk-form-width-medium" ng-model="widget.data['media_align']">
                            <option value="left">{{'Left' | trans}}</option>
                            <option value="right">{{'Right' | trans}}</option>
                        </select>
                    </div>
                </div>

                <div class="uk-form-row">
                    <label class="uk-form-label">{{'Image' | trans}}</label>
                    <div class="uk-form-controls">
                        <label><input class="uk-form-width-small" type="text" ng-model="widget.data['image_width']"> {{'Width (px)' | trans}}</label>
                        <p class="uk-form-controls-condensed">
                            <label><input class="uk-form-width-small" type="text" ng-model="widget.data['image_height']"> {{'Height (px)' | trans}}</label>
                        </p>
                    </div>
                </div>

            </li>
            <li>

                <h3 class="wk-form-heading">{{'Navigation' | trans}}</h3>

                <div class="uk-form-row">
                    <label class="uk-form-label" for="wk-nav">{{'Navigation' | trans}}</label>
                    <div class="uk-form-controls">
                        <select id="wk-nav" class="uk-form-width-medium" ng-model="widget.data['nav']">
                            <option value="none">{{'None' | trans}}</option>
                            <option value="dotnav">{{'Dotnav' | trans}}</option>
                            <option value="thumbnails">{{'Thumbnails' | trans}}</option>
                        </select>
                        <p class="uk-form-controls-condensed" ng-if="widget.data.nav != 'none'">
                            <label><input type="checkbox" ng-model="widget.data['nav_overlay']"> {{'Position the nav as overlay.' | trans}}</label>
                        </p>
                        <p class="uk-form-controls-condensed" ng-if="widget.data.nav != 'none'">
                            <label>
                                <select class="uk-form-width-small" ng-model="widget.data['nav_align']">
                                    <option value="left">{{'Left' | trans}}</option>
                                    <option value="center">{{'Center' | trans}}</option>
                                    <option value="right">{{'Right' | trans}}</option>
                                    <option value="justify">{{'Justify' | trans}} ({{'Only Thumbnails' | trans}})</option>
                                </select>
                                {{'Alignment' | trans}}
                            </label>
                        </p>
                        <p class="uk-form-controls-condensed" ng-if="widget.data.nav == 'thumbnails'">
                            <label><input class="uk-form-width-mini" type="text" ng-model="widget.data['thumbnail_width']"> {{'Width (px)' | trans}}</label>
                        </p>
                        <p class="uk-form-controls-condensed" ng-if="widget.data.nav == 'thumbnails'">
                            <label><input class="uk-form-width-mini" type="text" ng-model="widget.data['thumbnail_height']"> {{'Height (px)' | trans}}</label>
                        </p>
                    </div>
                </div>

                <div class="uk-form-row">
                    <label class="uk-form-label" for="wk-slidenav">{{'Slidenav' | trans}}</label>
                    <div class="uk-form-controls">
                        <select id="wk-slidenav" class="uk-form-width-medium" ng-model="widget.data['slidenav']">
                            <option value="none">{{'None' | trans}}</option>
                            <option value="default">{{'Default' | trans}}</option>
                            <option value="top-left">{{'Top/Left' | trans}}</option>
                            <option value="top-right">{{'Top/Right' | trans}}</option>
                            <option value="bottom-left">{{'Bottom/Left' | trans}}</option>
                            <option value="bottom-right">{{'Bottom/Right' | trans}}</option>
                        </select>
                    </div>
                </div>

                <div class="uk-form-row">
                    <span class="uk-form-label">{{'Invert Color' | trans}}</span>
                    <div class="uk-form-controls uk-form-controls-text">
                        <label><input type="checkbox" ng-model="widget.data['nav_contrast']"> {{'Invert dotnav and slidenav color if overlay.' | trans}}</label>
                    </div>
                </div>

                <h3 class="wk-form-heading">{{'Animations' | trans}}</h3>

                <div class="uk-form-row">
                    <label class="uk-form-label" for="wk-animation">{{'Animation' | trans}}</label>
                    <div class="uk-form-controls">
                        <select id="wk-animation" class="uk-form-width-medium" ng-model="widget.data['animation']">
                            <option value="fade">{{'Fade' | trans}}</option>
                            <option value="scroll">{{'Scroll' | trans}}</option>
                            <option value="swipe">{{'Swipe' | trans}}</option>
                            <option value="scale">{{'Scale' | trans}}</option>
                            <option value="slice-up">{{'Slice Up' | trans}}</option>
                            <option value="slice-down">{{'Slice Down' | trans}}</option>
                            <option value="slice-up-down">{{'Slice Up Down' | trans}}</option>
                            <option value="fold">{{'Fold' | trans}}</option>
                            <option value="puzzle">{{'Puzzle' | trans}}</option>
                            <option value="boxes">{{'Boxes' | trans}}</option>
                            <option value="boxes-reverse">{{'Boxes Reverse' | trans}}</option>
                            <option value="random-fx">{{'Random Fx' | trans}}</option>
                        </select>
                        <p class="uk-form-controls-condensed" ng-if="(['slice-up', 'slice-down', 'slice-up-down', 'fold', 'puzzle', 'boxes', 'boxes-reverse', 'random-fx'].indexOf(widget.data.animation) > -1)">
                            <label><input class="uk-form-width-mini" type="text" ng-model="widget.data['slices']"> {{'Slices' | trans}}</label>
                        </p>
                    </div>
                </div>

                <div class="uk-form-row">
                    <label class="uk-form-label" for="wk-duration">{{'Duration (ms)' | trans}}</label>
                    <div class="uk-form-controls">
                        <input id="wk-duration" class="uk-form-width-medium" type="text" ng-model="widget.data['duration']">
                    </div>
                </div>

                <div class="uk-form-row">
                    <span class="uk-form-label">{{'Autoplay' | trans}}</span>
                    <div class="uk-form-controls uk-form-controls-text">
                        <label><input type="checkbox" ng-model="widget.data['autoplay']"> {{'Enable autoplay' | trans}}</label>
                        <p class="uk-form-controls-condensed" ng-if="widget.data.autoplay">
                            <label><input class="uk-form-width-small" type="text" ng-model="widget.data['interval']"> {{'Interval (ms)' | trans}}</label>
                        </p>
                        <p class="uk-form-controls-condensed" ng-if="widget.data.autoplay">
                            <label><input type="checkbox" ng-model="widget.data['autoplay_pause']"> {{'Pause autoplay when hovering the slideshow' | trans}}</label>
                        </p>
                    </div>
                </div>

                <div class="uk-form-row">
                    <span class="uk-form-label">Kenburns</span>
                    <div class="uk-form-controls uk-form-controls-text">
                        <label><input type="checkbox" ng-model="widget.data['kenburns']"> {{'Enable Kenburns effect on the image' | trans}}</label>
                    </div>
                </div>

            </li>
            <li>

                <h3 class="wk-form-heading">{{'Text' | trans}}</h3>

                <div class="uk-form-row">
                    <span class="uk-form-label">{{'Display' | trans}}</span>
                    <div class="uk-form-controls uk-form-controls-text">
                        <p class="uk-form-controls-condensed">
                            <label><input type="checkbox" ng-model="widget.data['title']"> {{'Show title' | trans}}</label>
                        </p>
                        <p class="uk-form-controls-condensed">
                            <label><input type="checkbox" ng-model="widget.data['content']"> {{'Show content' | trans}}</label>
                        </p>
                    </div>
                </div>

                <div class="uk-form-row">
                    <label class="uk-form-label" for="wk-title-size">{{'Title Size' | trans}}</label>
                    <div class="uk-form-controls">
                        <select id="wk-title-size" class="uk-form-width-medium" ng-model="widget.data['title_size']">
                            <option value="panel">{{'Default' | trans}}</option>
                            <option value="h1">H1</option>
                            <option value="h2">H2</option>
                            <option value="h3">H3</option>
                            <option value="h4">H4</option>
                            <option value="large">{{'Extra Large' | trans}}</option>
                        </select>
                    </div>
                </div>

                <div class="uk-form-row">
                    <label class="uk-form-label" for="wk-text-align">{{'Alignment' | trans}}</label>
                    <div class="uk-form-controls">
                        <select id="wk-text-align" class="uk-form-width-medium" ng-model="widget.data['text_align']">
                            <option value="default">{{'Default' | trans}}</option>
                            <option value="left">{{'Left' | trans}}</option>
                            <option value="right">{{'Right' | trans}}</option>
                            <option value="center">{{'Center' | trans}}</option>
                        </select>
                    </div>
                </div>

                <h3 class="wk-form-heading">{{'Link' | trans}}</h3>

                <div class="uk-form-row">
                    <span class="uk-form-label">{{'Display' | trans}}</span>
                    <div class="uk-form-controls uk-form-controls-text">
                        <label><input type="checkbox" ng-model="widget.data['link']"> {{'Show link' | trans}}</label>
                    </div>
                </div>

                <div class="uk-form-row">
                    <label class="uk-form-label" for="wk-link-style">{{'Style' | trans}}</label>
                    <div class="uk-form-controls">
                        <select id="wk-link-style" class="uk-form-width-medium" ng-model="widget.data['link_style']">
                            <option value="text">{{'Text' | trans}}</option>
                            <option value="button">{{'Button' | trans}}</option>
                            <option value="primary">{{'Button Primary' | trans}}</option>
                            <option value="button-large">{{'Button Large' | trans}}</option>
                            <option value="primary-large">{{'Button Large Primary' | trans}}</option>
                        </select>
                    </div>
                </div>

                <div class="uk-form-row">
                    <label class="uk-form-label" for="wk-link-text">{{'Text' | trans}}</label>
                    <div class="uk-form-controls">
                        <input id="wk-link-text" class="uk-form-width-medium" type="text" ng-model="widget.data['link_text']">
                    </div>
                </div>

                <h3 class="wk-form-heading">{{'Badge' | trans}}</h3>

                <div class="uk-form-row">
                    <label class="uk-form-label" for="wk-badge-style">{{'Style' | trans}}</label>
                    <div class="uk-form-controls">
                        <select id="wk-badge-style" class="uk-form-width-medium" ng-model="widget.data['badge_style']">
                            <option value="badge">{{'Default' | trans}}</option>
                            <option value="success">{{'Success' | trans}}</option>
                            <option value="warning">{{'Warning' | trans}}</option>
                            <option value="danger">{{'Danger' | trans}}</option>
                            <option value="text-muted">{{'Text Muted' | trans}}</option>
                            <option value="text-primary">{{'Text Primary' | trans}}</option>
                        </select>
                    </div>
                </div>

            </li>
            <li>

                <h3 class="wk-form-heading">{{'Custom' | trans}}</h3>

                <div class="uk-form-row">
                    <label class="uk-form-label" for="wk-class">{{'HTML Class' | trans}}</label>
                    <div class="uk-form-controls">
                        <input id="wk-class" class="uk-form-width-medium" type="text" ng-model="widget.data['class']">
                    </div>
                </div>

            </li>
        </ul>

    </div>
</div>