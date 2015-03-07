<?php

    global $wpdb;

    $fields =  $wpdb->get_col($wpdb->prepare("SELECT DISTINCT meta_key FROM {$wpdb->postmeta} WHERE meta_key NOT LIKE %s ORDER BY meta_key", $wpdb->esc_like( '_' ).'%'));

?>

<div class="uk-form uk-form-stacked" ng-class="vm.name == 'contentCtrl' ? 'uk-width-large-2-3 wk-width-xlarge-1-2' : ''" ng-controller="wordpressCtrl as wp">

    <h3 class="wk-form-heading">{{'Content' | trans}}</h3>

    <div class="uk-form-row">
        <label class="uk-form-label" for="wk-category">{{'Category' | trans}}</label>
        <div class="uk-form-controls">
            <select id="wk-category" class="uk-width-1-1" ng-model="content.data['category']" multiple>
                <?php foreach (get_categories() as $category) : ?>
                    <option value="<?php echo $category->cat_ID; ?>"><?php echo $category->name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="uk-form-row">
        <label class="uk-form-label" for="wk-number">{{'Limit' | trans}}</label>
        <div class="uk-form-controls">
            <input id="wk-number" class="uk-width-1-1" type="number" value="5" min="1" step="1" ng-model="content.data['number']">
        </div>
    </div>

    <div class="uk-form-row">
        <label class="uk-form-label" for="wk-order">{{'Order' | trans}}</label>
        <div class="uk-form-controls">
            <select id="wk-order" class="uk-width-1-1" ng-model="content.data['order_by']">
                <option value="post_none">{{'Default' | trans}}</option>
                <option value="post_date">{{'Latest First' | trans}}</option>
                <option value="post_date_asc">{{'Latest Last' | trans}}</option>
                <option value="post_title">{{'Alphabetical' | trans}}</option>
                <option value="post_title_asc">{{'Alphabetical Reversed' | trans}}</option>
                <option value="post_author">{{'Author' | trans}}</option>
                <option value="post_author_asc">{{'Author Reversed' | trans}}</option>
                <option value="post_modified">{{'Modified' | trans}}</option>
                <option value="post_modified_asc">{{'Modified Reversed' | trans}}</option>
                <option value="rand">{{'Random' | trans}}</option>
            </select>
        </div>
    </div>

    <h3 class="wk-form-heading uk-margin-large-top">{{'Mapping' | trans}}</h3>

    <div class="uk-grid uk-grid-small uk-grid-width-1-2">
        <div>

            <label class="uk-form-label">{{'Name' | trans}}</label>
            <div class="uk-form-controls">
                <input type="text" class="uk-width-1-1" value="content" disabled>
            </div>

        </div>
        <div>

            <label class="uk-form-label">{{'Field' | trans}}</label>
            <div class="uk-form-controls">
                <select class="uk-width-1-1" ng-model="content.data['content']">
                    <option value="intro">{{'Intro' | trans}}</option>
                    <option value="full">{{'Full' | trans}}</option>
                    <option value="excerpt">{{'Excerpt' | trans}}</option>
                </select>
            </div>

        </div>
    </div>

    <div class="uk-grid uk-grid-small uk-grid-width-1-2" ng-repeat="map in wp.mapping">
        <div>

            <input class="uk-width-1-1" type="text" ng-model="map.name" placeholder="{{'Field name' | trans}}">

        </div>
        <div class="uk-flex uk-flex-middle">

            <select class="uk-width-1-1" ng-model="map.field">
                <?php foreach ($fields as $field) : ?>
                <option value="<?php echo $field; ?>"><?php echo $field; ?></option>
                <?php endforeach; ?>
            </select>

            <a class="uk-margin-left uk-text-danger" ng-click="wp.deleteMap(map)"><i class="uk-icon-trash-o"></i></a>

        </div>
    </div>

    <p>
        <a class="uk-button" ng-click="wp.addMap()">{{'Add' | trans}}</a>
    </p>

</div>
