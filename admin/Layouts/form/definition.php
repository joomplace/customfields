<?php
/**
 * Created by PhpStorm.
 * User: Alexandr
 * Date: 29.10.2016
 * Time: 16:10
 */

defined('_JEXEC') or die;

extract($displayData);

/**
 * List of all native fields for Joomla
 *
 * accesslevel
 * cachehandler
 * calendar
 * captcha
 * category
 * checkbox
 * checkboxes
 * Chrome Style
 * color
 * Content Language
 * Content Type
* combo
* componentlayout
* contentlanguage
* Database Connection
* editor
* editors
* email
* file
* filelist
* folderlist
* groupedlist
* header tag
* helpsite
* hidden
* imagelist
* integer
* language
* list
* media
* menu
* Menu Item
* meter
* note
* number
* password
* plugins
* predefinedlist
* radio
* range
* repeatable
* rules
* sessionhandler
* spacer
* sql
* subform
* tag
* tel
* templatestyle
* text
* textarea
* timezone
* URL
* user
* useractive
* usergroup
* usergrouplist
* userstate
 *
 */
JFactory::getDocument()->addScript('https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js');
?>
<section ng-app="definitionsApp">
	<script>
		var app = angular.module('definitionsApp', []);
		app.controller('definitionsController', ['$scope',function($scope) {
			var ctrl = this;
			$scope.definition = <?php echo $value ?>;
			var types = {
				checkboxes:"varchar(128)",
			};
			$scope.setType = function(){
				$scope.definition.mysql_type = types[$scope.definition.type];
			}
			$scope.unset = function(key, arr){
				delete arr[key];
			}
		}]);
	</script>
	<div ng-controller="definitionsController as ctrl">
		<select ng-model="definition.type" ng-change="setType()">
			<option value="text">Simple text input</option>
			<option value="tel">Phone number</option>
			<option value="checkboxes">Checkboxes</option>
			<option value="url">Url</option>
		</select>
		<label>
			Label
		</label>
		<input type="text" ng-model="definition.label" />
		<label>
			Tip
		</label>
		<input type="text" ng-model="definition.description" />
		<label>
			Css class of input
		</label>
		<input type="text" ng-model="definition.class" />
		<label>
			Is required
		</label>
		<input type="checkbox" ng-true-value="'true'" ng-model="definition.required" />
		<div ng-show="definition.type=='checkboxes'">
			<label>
				Options
			</label>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>
							value
						</th>
						<th>
							Text
						</th>
						<th width="15%"></th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="(key,option) in definition.option">
						<td>
							{{key}}
						</td>
						<td>
							{{option}}
						</td>
						<td style="text-align: center;">
							<span ng-click="unset(key, definition.option);" class="btn btn-defeult"><i class="icon-trash"> </i> Remove option</span>
						</td>
					</tr>
					<tr>
						<td>
							<input class="input" ng-model="new.key" placeholder="{{new.option}}" />
						</td>
						<td>
							<input class="input" ng-model="new.option" />
						</td>
						<td style="text-align: center;">
							<span ng-click="definition.option[new.key?new.key:new.option] = new.option; new.key = new.option = '';" class="btn btn-primary"><i class="icon-plus"> </i> Add option</span>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<input name="<?php echo $name ?>" type="hidden" value="{{definition}}" />
		<pre>{{definition}}</pre>
	</div>
</section>
