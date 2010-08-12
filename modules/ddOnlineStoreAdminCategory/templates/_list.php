<div class="sf_admin_list">
  <?php if (!$pager->getNbResults()): ?>
    <p><?php echo __('No result', array(), 'sf_admin') ?></p>
  <?php else: ?>
    <table cellspacing="0" id="sf_product_category_table">
      <thead>
        <tr>
          <th id="sf_admin_list_batch_actions"><input id="sf_admin_list_batch_checkbox" type="checkbox" onclick="checkAll();" /></th>
          <?php include_partial('ddOnlineStoreAdminCategory/list_th_tabular', array('sort' => $sort)) ?>
          <th id="sf_admin_list_th_actions"><?php echo __('Actions', array(), 'sf_admin') ?></th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th colspan="3">
            <?php if ($pager->haveToPaginate()): ?>
              <?php include_partial('ddOnlineStoreAdminCategory/pagination', array('pager' => $pager)) ?>
            <?php endif; ?>

            <?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults(), 'sf_admin') ?>
            <?php if ($pager->haveToPaginate()): ?>
              <?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage()), 'sf_admin') ?>
            <?php endif; ?>
          </th>
        </tr>
      </tfoot>
      <tbody>
        <?php foreach ($pager->getResults() as $i => $product_category): $odd = fmod(++$i, 2) ? 'odd' : 'even' ?>
          <tr class="sf_admin_row <?php echo $odd ?>">
            <?php include_partial('ddOnlineStoreAdminCategory/list_td_batch_actions', array('product_category' => $product_category, 'helper' => $helper)) ?>
            <?php include_partial('ddOnlineStoreAdminCategory/list_td_tabular', array('product_category' => $product_category)) ?>
            <?php include_partial('ddOnlineStoreAdminCategory/list_td_actions', array('product_category' => $product_category, 'helper' => $helper)) ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>
<script type="text/javascript">
/* <![CDATA[ */
function checkAll()
{
  var boxes = document.getElementsByTagName('input'); for(var index = 0; index < boxes.length; index++) { box = boxes[index]; if (box.type == 'checkbox' && box.className == 'sf_admin_batch_checkbox') box.checked = document.getElementById('sf_admin_list_batch_checkbox').checked } return true;
}

$(document).ready(function() {
  $("#sf_product_category_table").tableDnD({
    onDrop: function(table, row) {
     	$('.error').remove();
        $('.notice').remove();
        $('#sf_admin_header').before('<div class="waiting"><?php echo __('Sending data to server.');?><\/div>');
        
        var rows = table.tBodies[0].rows;
 
        // Get the moved item's id
        var movedId = $(row).find('td input:checkbox').val();
                
        // Calculate the new row's position
        var destNodeId = false;
        var founded = false;
        var moveType = 'after';
        for(var i=0; i<rows.length; i++) 
        {
        	var cells = rows[i].childNodes;
            nodeId = $(cells[1]).find('input:checkbox').val();
            
            if(founded)
            {
                if(destNodeId == false)
                {
                    destNodeId = nodeId;
                    var moveType = 'before';
                }
            }else
            {
            	//Perform the ajax request for the new position
                if (movedId == nodeId) 
                {
	                founded = true;
                }else
                {
                	destNodeId = nodeId;
                }
            }
        }

        //alert(movedId+" - "+destNodeId+":"+moveType);
        if(destNodeId !== false)
        {
            $.ajax({
              url:      "<?php echo url_for('online_store_admin_category_move') ?>",
              type:     "POST",
              dataType: "json",
              data:     "id="+ movedId +"&destNodeId="+ destNodeId +"&movetype="+moveType,
              complete: function(){
                  $('.waiting').remove();
              },
              success:  function (data, textStatus) {
                  $('#sf_admin_header').before('<div class="notice"><?php echo __('The item was moved successfully.');?><\/div>');
              },
              error:    function (data, textStatus) {
                  $('#sf_admin_header').before('<div class="error"><?php echo __('Error while moving the item.');?><\/div>');
              }
            });
        }else
        {
        	$('.waiting').remove();
        }
      }
  });
});
/* ]]> */
</script>
