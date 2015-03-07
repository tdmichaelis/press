<div ng-controller="pickerCtrl as vm" ng-switch="view">

    <div ng-switch-when="content">

        <div class="uk-modal-header" ng-if="!widget">
            <div class="uk-h2 uk-text-muted">{{'Select Widget' | trans}}</div>
        </div>

        <div class="uk-modal-header wk-modal-header-blank uk-flex uk-flex-middle" ng-if="widget">

            <div class="uk-margin-small-right">
                <img ng-src="{{ widget.icon }}" width="30" height="30" alt="{{ widget.label }}">
            </div>
            <div class="uk-flex-item-1 uk-h2 uk-margin-remove">{{ widget.label }}</div>
            <a class="uk-button" ng-click="vm.listWidgets()">{{'Change Widget' | trans}}</a>

        </div>

        <div class="uk-modal-header uk-flex uk-form" ng-show="widget">

            <select class="uk-flex-item-1" ng-model="$parent.selected" ng-options="cont.name for cont in data.content | toArray | supported:widget | orderBy : 'name'">
                <option value="">- {{'Select content' | trans}} -</option>
            </select>

            <button class="uk-button uk-margin-small-left" ng-show="selected" ng-click="vm.editContent()" type="button">{{'Edit' | trans}}</button>

            <div class="uk-button-dropdown uk-margin-small-left" data-uk-dropdown="{ mode: 'click' }">
                <button class="uk-button" type="button">{{'New' | trans}}</button>
                <div class="uk-dropdown uk-dropdown-small uk-dropdown-flip">
                    <ul class="uk-nav uk-nav-dropdown">
                        <li class="uk-nav-header">{{'Content Types' | trans}}</li>
                        <li ng-repeat="type in data.types"><a ng-click="vm.createContent(type)">{{ type.label }}</a></li>
                    </ul>
                </div>
            </div>

        </div>

        <div ng-show="widget">
            <div ng-if="widget" ng-include="widget.name + '.edit'"></div>
        </div>

        <div ng-hide="widget">
            <ul class="uk-grid uk-grid-width-1-2 uk-grid-width-small-1-3 uk-grid-width-medium-1-5 uk-margin-large-top uk-margin-large-bottom" data-uk-grid-margin>
                <li ng-repeat="widget in data.widgets" ng-if="widget.core">

                    <a class="uk-panel uk-panel-hover uk-text-center" ng-click="vm.selectWidget(widget)">
                        <img ng-src="{{ widget.icon }}" width="40" height="40" alt="{{ widget.label }}">
                        <h3 class="uk-h4 uk-margin-top uk-margin-bottom-remove">{{ widget.label }}</h3>
                    </a>

                </li>
            </ul>

            <div ng-if="vm.hasCustomWidgets">

                <h3 class="wk-modal-heading">Theme</h3>

                <ul class="uk-grid uk-grid-width-1-2 uk-grid-width-small-1-3 uk-grid-width-medium-1-5 uk-margin-large-top uk-margin-large-bottom" data-uk-grid-margin>
                    <li ng-repeat="widget in data.widgets" ng-if="!widget.core">

                        <a class="uk-panel uk-panel-hover uk-text-center" ng-click="vm.selectWidget(widget)">
                            <img ng-src="{{ widget.icon }}" width="40" height="40" alt="{{ widget.label }}">
                            <h3 class="uk-h4 uk-margin-top uk-margin-bottom-remove">{{ widget.label }}</h3>
                        </a>

                    </li>
                </ul>
            </div>

        </div>

        <div class="uk-modal-footer">
            <button type="button" class="uk-button" ng-click="vm.close()">{{'Close' | trans}}</button>
            <button type="button" class="uk-button uk-button-primary" ng-show="selected && widget" ng-click="vm.save()">{{'Insert' | trans }}</button>
        </div>

    </div>
    <div ng-switch-when="contentEdit">

        <form class="uk-margin-remove" name="form" novalidate>

            <div class="uk-modal-header uk-form">
                <input type="text" ng-model="content.name" class="uk-form-large uk-width-1-1" placeholder="{{'Name' | trans}}" autofocus required>
            </div>

            <div ng-include="content.type + '.edit'"></div>

            <div class="uk-modal-footer">
                <button class="uk-button" ng-click="vm.closeContent()">{{'Close' | trans}}</button>
                <button class="uk-button uk-button-primary" ng-click="vm.saveContent(content)" ng-disabled="form.$invalid">{{'Save' | trans}}</button>
            </div>

        </form>

    </div>
</div>
