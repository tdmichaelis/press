<div data-app="widgetkit" ng-controller="contentCtrl as vm" ng-switch="view" ng-cloak data-uk-observe>

    <div ng-switch-when="content">

        <h2 class="js-header">{{'Content' | trans}}</h2>

        <hr class="uk-margin-bottom">

        <div class="uk-clearfix">

            <div class="js-header uk-button-dropdown" data-uk-dropdown="{ mode: 'click' }">
                <button class="uk-button uk-button-primary" type="button">{{'New Content' | trans}} <i class="uk-icon-caret-down"></i></button>
                <div class="uk-dropdown uk-dropdown-small">
                    <ul class="uk-nav uk-nav-dropdown">
                        <li class="uk-nav-header">{{'Content Types' | trans}}</li>
                        <li ng-repeat="type in data.types"><a ng-click="vm.createContent(type)">{{ type.label }}</a></li>
                    </ul>
                </div>
            </div>

            <div class="uk-float-right uk-form" ng-show="data.content | length">
                <input class="uk-form-width-small uk-margin-small-right" type="text" ng-model="search.name" placeholder="{{'Search...' | trans}}">
                <div class="uk-button-group">
                    <button class="uk-button" ng-class="{'uk-active':(vm.viewmode == 'list')}" ng-click="vm.setViewMode('list')"><i class="uk-icon-bars"></i></button>
                    <button class="uk-button" ng-class="{'uk-active':(vm.viewmode == 'blocks')}" ng-click="vm.setViewMode('blocks')"><i class="uk-icon-th"></i></button>
                </div>
            </div>

        </div>

        <ul class="uk-margin-top uk-grid uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-4 uk-grid-width-xlarge-1-6" data-uk-grid-margin ng-if="(vm.viewmode == 'blocks' && data.content | length)">
            <li ng-repeat="content in data.content | toArray | filter:search | orderBy:'name'">

                <a class="uk-panel uk-panel-box uk-panel-box-hover uk-visible-hover" ng-click="vm.editContent(content)">

                    <div class="uk-panel-teaser uk-cover-background wk-image" ng-style="{'background-image': 'url(' + vm.previewContent(content) + ')'}"></div>

                    <p class="uk-h4 uk-margin-top-remove uk-flex">
                        <span class="uk-flex-item-1">{{ content.name }}</span>
                        <i class="uk-icon-trash-o uk-hidden" ng-click="vm.deleteContent(content); $event.stopPropagation()"></i>
                    </p>

                </a>
            </li>
        </ul>

        <div class="uk-panel uk-panel-box uk-margin" ng-if="(vm.viewmode == 'list' && data.content | length)">
            <table class="uk-table uk-table-hover uk-table-middle wk-table-link uk-h4 uk-link-reset">
                <tbody>
                    <tr class="uk-visible-hover-inline" ng-repeat="content in data.content | toArray | filter:search | orderBy:'name'">
                        <td class="wk-table-link">
                            <a ng-click="vm.editContent(content)">
                                <div class="wk-preview-thumb uk-cover-background uk-margin-right" ng-style="{'background-image': 'url(' + vm.previewContent(content) + ')'}"></div>
                                {{ content.name }}
                            </a>
                        </td>
                        <td class="wk-table-width-minimum">
                            <a class="uk-invisible" ng-click="vm.deleteContent(content); $event.stopPropagation()"><i class="uk-icon-trash-o"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p class="uk-text-muted uk-text-center" ng-hide="data.content | length">
            {{"You've no content created yet" | trans}}
        </p>

    </div>
    <div ng-switch-when="contentEdit">

        <h2 class="uk-margin-bottom js-header">{{ content.id ? ('Edit %content% %type%' | trans: {'content': content.name, 'type': content.type}) : ('Create Content %type%' | trans: {'type': content.type}) }}</h2>

        <form name="form" novalidate>

            <div class="uk-form uk-margin-bottom">
                <input type="text" ng-model="content.name" class="uk-form-large uk-width-1-1" placeholder="{{'Name' | trans}}" required autofocus>
            </div>

            <div class="uk-panel uk-panel-box" ng-include="content.type + '.edit'"></div>

            <p class="js-action-buttons">
                <button class="uk-button uk-button-primary" ng-click="vm.saveContent()" ng-disabled="form.$invalid">{{'Save' | trans}}</button>
                <button class="uk-button" ng-click="vm.closeContent()">{{'Close' | trans}}</button>
            </p>

        </form>

    </div>
</div>
