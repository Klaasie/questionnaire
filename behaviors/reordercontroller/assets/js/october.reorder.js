/*
 * Scripts for the Reorder controller behavior.
 *
 * The following functions are observed:
 * - Simple sorting: Post back the original sort orders and the new ordered identifiers.
 * - Nested sorting: Post back source and target nodes IDs and the move positioning.
 */
+function ($) { "use strict";

    var ReorderBehavior = function() {

        this.sortMode = null

        this.simpleSortIds = []
        this.simpleSortOrders = []

        this.initSorting = function () {
            $('#reorderTreeList').on('move.oc.treelist', $.proxy(this.processReorder, this))
        }


        this.processReorder = function(ev, sortData){
            var postData

            this.initSortingSimple()
            postData = this.getNestedMoveData(sortData)

            if (postData.position == 'child') {
                $.popup({
                    handler: 'onLoadAnswers',
                    extraData: postData
                });
            } else {
                $('#reorderTreeList').request('onReorder', {
                    data: postData
                })
            }
        }

        this.getNestedMoveData = function (sortData) {
            var
                $el,
                $item = sortData.item,
                moveData = {
                    targetNode: 0,
                    sourceNode: $item.data('recordId'),
                    position: 'root'
                }

            moveData.sort_ids = this.simpleSortIds;
            moveData.sort_orders = this.simpleSortOrders;

            if (($el = $item.parents('li:first')) && $el.length) {
                moveData.position = 'child';
                // Open popup
            }
            else if (($el = $item.next()) && $el.length) {
                moveData.position = 'before'
            }
            else if (($el = $item.prev()) && $el.length) {
                moveData.position = 'after'
            }

            if ($el.length) {
                moveData.targetNode = $el.data('recordId')
            }

            return moveData
        }

        this.initSortingSimple = function () {
            var sortOrders = []
            var sortIds = [];

            $('#reorderRecords').children('li').each(function(){
                sortIds.push($(this).data('recordId'));
                sortOrders.push($(this).data('recordSortOrder'))
            })

            this.simpleSortIds = sortIds;
            this.simpleSortOrders = sortOrders
        }

    }

    $.oc.reorderBehavior = new ReorderBehavior;
}(window.jQuery);