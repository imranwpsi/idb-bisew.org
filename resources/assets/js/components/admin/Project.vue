<template>
    <div>
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#apply_widget">Apply Widget</a></li>
            <li><a data-toggle="tab" href="#project_info">Projects Info</a></li>
        </ul>

        <div class="tab-content">
            <div id="apply_widget" class="tab-pane fade in active">
                <h3>HOME</h3>
                <p>Some content.</p>
            </div>
            <div id="project_info" class="tab-pane fade">
                <h3>Menu 1</h3>
                <p>Some content in menu 1.</p>
            </div>
        </div>
    </div>
</template>
<script>
	export default{
        name: 'project',
    }
</script>
