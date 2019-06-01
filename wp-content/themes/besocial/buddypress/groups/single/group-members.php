<div class="besocial-group-search">
    <ul>
        <li class="groups-members-search" role="search">
            <?php bp_directory_members_search_form(); ?>
        </li>
            <?php 
 
            /** 
             * Fires at the end of the group members search unordered list. 
             * 
             * Part of bp_groups_members_template_part(). 
             * 
             * @since 1.5.0 
             */ 
            do_action( 'bp_members_directory_member_sub_types' ); ?>

    </ul>
</div>

<div id="besocial-bp-bar" class="marginbottom">
    <ul id="besocial-bp-bar-right">
        <?php bp_groups_members_filter(); ?>
    </ul>
</div>

<div id="members-group-list" class="group_members dir-list">

    <?php bp_get_template_part( 'groups/single/members' ); ?>

</div>