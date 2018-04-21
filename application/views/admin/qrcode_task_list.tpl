<{include file="admin/layout_header.tpl"}>
<div class="panel panel-default panel-intro">
    <div class="panel-body">
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="one">
                <div class="widget-body no-padding">
                    <div id="toolbar" class="toolbar">

                    </div>
                    <table id="table" class="table table-striped table-bordered table-hover"
                           data-operate-add="/adviser/add"
                           data-operate-edit="/adviser/edit"
                           data-operate-del="/adviser/del"
                           width="100%">
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
<{include file="admin/layout_footer.tpl"}>
