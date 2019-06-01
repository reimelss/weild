<div class="bpsh-admin-screen">
    <h3> BuddyPress Shortcodes </h3>
    <div class="bpsh-admin-content">
        BuddyPress Shortcode plugin allows you to embed BuddyPress Activities, BuddyPress Members and Groups in posts/pages using shortcodes.
        <div class="bpsh-admin-shortcode-title"> Activity Shortcodes: </div>
        <div class="bpsh-admin-shortcode">
            <b>[activity-listing]</b>
        </div>
        <div class="bpsh-admin-shortcode-content">
            <p>Here is the way you can specify options</p>
            <p class="bpsh-admin-shortcode">
                <strong>[activity-listing option_name=option_val option_name2=option_val2  and so on]</strong>
            </p>
            <p>The accepted parameters:-</p>
            <ul>
                <li>
                    <strong>title</strong>(string) :- What should be the title of the activities section
                </li>
                <li>
                    <strong>display_comments</strong>(sting|bool):- How to handle activity comments.<br/>
                    <b>Possible values:</b> - 'threaded' - comments appear in a threaded tree, under their parent items.<br/>
                    - 'stream' - the activity stream is presented in a flat manner, with comments sorted in chronological order alongside other activity items.<br/>
                    - false - don't fetch activity comments at all.<br/>
                    Default: 'threaded'.
                </li>
                <li>
                    <strong>include</strong>(array|bool):- Array of exact activity IDs to query. Providing an 'include' array will override all other filters passed in the argument array. When viewing the permalink page for a single activity item, this value defaults to the ID of that item. Otherwise the default is false.
                </li>
                <li>
                    <strong>in</strong>(array|bool):- Array of IDs to limit query by (IN). 'in' is intended to be used in conjunction with other filter parameters. Default: false.
                </li>
                <li>
                    <strong>exclude</strong>(array|bool):- Array of activity IDs to exclude. Default: false.
                </li>
                <li>
                    <strong>sort</strong>(string):- 'ASC' or 'DESC'. Default: 'DESC'.
                </li>
                <li>
                    <strong>page</strong> (int):- Which page of results to fetch. Using page=1 without per_page will result in no pagination. Default: 1.
                </li>
                <li>
                    <strong>per_page</strong>(int):- Number of results per page. Default: 20.
                </li>
                <li>
                    <strong>page_args</strong>(int):- String used as a query parameter in pagination links. Default: 'acpage'.
                </li>
                <li>
                    <strong>max</strong>(int):- Limit the maximum no. of activities to be included in the list
                </li>
                <li>
                    <strong>fields</strong>(string):- Activity fields to retrieve. 'all' to fetch entire activity objects, 'ids' to get only the activity IDs. Default 'all'.
                </li>
                <li>
                    <strong>scope</strong>(string):- Use a BuddyPress pre-built filter.
                    <br/>   - 'just-me' retrieves items belonging only to a user; this is equivalent to passing a 'user_id' argument.
                    <br/>   - 'friends' retrieves items belonging to the friends of a user.
                    <br/>   - 'groups' retrieves items belonging to groups to which a user belongs to.
                    <br/>   - 'favorites' retrieves a user's favorited activity items.
                    <br/>   - 'mentions' retrieves items where a user has received an @-mention.
                    <br/>   The default value of 'scope' is set to one of the above if that value appears in the appropriate place in the URL; eg, 'scope' will be 'groups'
                    <br/>   when visiting http://example.com/members/joe/activity/groups/.
                    <br/>   Otherwise defaults to false.
                </li>
                <li>
                    <strong>user_id</strong>(int):- If you want to list a&nbsp;particular&nbsp;user’s activity
                </li>
                <li>
                    <strong>object</strong>(string):-&nbsp;object to filter on e.g. groups, profile, status, friends(what type of activity is this)
                </li>
                <li>
                    <strong>action</strong>(string):-&nbsp;action to filter on e.g. activity_update, new_forum_post, profile_updated(why this activity was created)
                </li>
                <li>
                    <strong>primary_id</strong>(int):-&nbsp;object ID to filter on e.g. a group_id or forum_id or blog_id etc. We will see the use in a minute.
                </li>
                <li>
                    <strong>secondary_id</strong>(int):-&nbsp;secondary object ID to filter on e.g. a post_id(I don’t think you are going to use it)
                </li>
                <li>
                    <strong>search_terms</strong>(String):- In case you want to list the results of activity search
                </li>
                <li>
                    <strong>allow_posting</strong>(int):- If you want to allow users to post. It will include the default activity posting form. It is experimental and may have issues on some of the themes.
                </li>
                <li>
                    <strong>hide_on_activity</strong>(int):- Default 1. Hide/show the shortcode content on activity pages(If you are using it in sidebar and want it to be visible on user/group/site activity page, set it to 0)
                </li>
                <li>
                    <strong>container_class</strong>(string):- Default ‘activity’ . Allows to change the class of the shortcode contents wrapper. If you have the hide_on_activity=0, then please set it to some other value than ‘activity'(May be ‘activities’ or something else). If you do not change it, On the user/group/site activity page, the activity filter will affect the content of the shotrcode. It is suggested to change it if hide_on_activity=0 is set.
                </li>
            </ul>
            <div class="bpsh-admin-shortcode">
                <h3>Examples:-</h3>

                <p><b>[activity-listing user_id=1]</b></p>

                <p><b>[activity-listing per_page=10]</b></p>

                <p><b>[activity-listing search_terms='awesome']</b></p>

                <p><b>[activity-listing object=groups]</b></p>

                <p><b>[activity-listing object=groups primary_id=2]</b></p>
            </div>
        </div>
        <div class="bpsh-admin-shortcode-title"> Members Shortcodes :- </div>
        <div class="bpsh-admin-shortcode">
            <b>[members-listing]</b>
        </div>
        <div class="bpsh-admin-shortcode-content">
            <p>Here is the way you can specify options</p>
            <p class="bpsh-admin-shortcode">
                <strong>[members-listing option_name=option_val option_name2=option_val2  and so on]</strong>
            </p>
            <p>The accepted parameters:-</p>
            <ul>
                <li>
                    <strong>title</strong>(string) :- What should be the title of the members section
                </li>
                <li>
                    <strong>type</strong>(string):- Sort order. Accepts 'active', 'random', 'newest', 'popular', 'online', 'alphabetical'. Default: 'active'.
                </li>
                <li>
                    <strong>per_page</strong>(int|bool):- Number of results per page. Default: 20.
                </li>
                <li>
                    <strong>page</strong>(int|bool):- Page of results to display. Default: 1.
                </li>
                <li>
                    <strong>max</strong>(int|bool):- Maximum number of results to return. Default: false (unlimited).
                </li>
                <li>
                    <strong>include</strong>(array|int|string|bool):- Limit results by a list of user IDs. Accepts an array, a single integer, a comma-separated list of IDs, or false (to disable this limiting). Accepts 'active', 'alphabetical','newest', or 'random'. Default: false.
                </li>
                <li>
                    <strong>exclude</strong>(array|int|string|bool):- Exclude users from results by ID. Accepts an array, a single integer, a comma-separated list of IDs, or false (to disable this limiting). Default: false.
                </li>
                <li>
                    <strong>user_id</strong>(int):- If provided, results are limited to the friends of the specified user. When on a user's Friends page, defaults to the ID of the displayed user. Otherwise defaults to 0.
                </li>
                <li>
                    <strong>member_type</strong>(string):- Can be a comma-separated list. (Note: BuddyPress itself does not register any member types. Plugins and themes can register member types using the bp_register_member_type() or the bp_register_member_types() function.)
                </li>
                <li>
                    <strong>include_member_role</strong>(string):- Can be a comma-separated list of members role.
                </li>
                <li>
                    <strong>exclude_member_role</strong>(string):- Can be a comma-separated list of members role.
                </li>
                <li>
                    <strong>member_type__in</strong> (string):- list only these members type ( Note: This parameter will work when member types exist.)
                </li>
                <li>
                    <strong>member_type__not_in</strong> (string):- not list these members type ( Note: This parameter will work when member types exist.)
                </li>
                <li>
                    <strong>search_terms</strong> (string):- Limit results by a search term. Default: value of `$_REQUEST['members_search']` or `$_REQUEST['s']`, if present. Otherwise false.
                </li>
                <li>
                    <strong>meta_key</strong> (string):- Limit results by the presence of a usermeta key. Default: false.
                </li>
                <li>
                    <strong>meta_value</strong> (string):- When used with meta_key, limits results by the a matching usermeta value. Default: false. Requires meta_key.
                </li>
            </ul>
            <div class="bpsh-admin-shortcode">
                <h3>Examples:-</h3>

                <p><b>[members-listing user_id=1]</b></p>

                <p><b>[members-listing per_page=10]</b></p>

                <p><b>[members-listing search_terms='awesome']</b></p>

                <p><b>[members-listing include_member_role='subscriber,author']</b></p>
            </div>
        </div>
        <div class="bpsh-admin-shortcode-title"> Group Shortcodes :- </div>
        <div class="bpsh-admin-shortcode">
            <b>[groups-listing]</b>
        </div>
        <div class="bpsh-admin-shortcode-content">
            <p>Here is the way you can specify options</p>
            <p class="bpsh-admin-shortcode">
                <strong>[groups-listing option_name=option_val option_name2=option_val2  and so on]</strong>
            </p>
            <p>The accepted parameters:-</p>
            <ul>
                <li>
                    <strong>title</strong>(string) :- What should be the title of the groups section.
                </li>
                <li>
                    <strong>type</strong>(string):- Shorthand for certain orderby/order combinations. 'newest', 'active', 'popular', 'alphabetical', 'random'. When present, will override orderby and order params. Default: null.
                </li>
                <li>
                    <strong>order</strong>(string):- Sort order. 'ASC' or 'DESC'. Default: 'DESC'.
                </li>
                <li>
                    <strong>orderby</strong>(string):- Property to sort by. 'date_created', 'last_activity', 'total_member_count', 'name', 'random'. Default: 'last_activity'.
                </li>
                <li>
                    <strong>per_page</strong>(int|bool):- Number of items to return per page of results. Default: 20.
                </li>
                <li>
                    <strong>page</strong>(int|bool):- Page offset of results to return. Default: 1 (first page of results).
                </li>
                <li>
                    <strong>max</strong>(int|bool):- Does NOT affect query. May change the reported number of total groups found, but not the actual number of found groups. Default: false.
                </li>
                <li>
                    <strong>show_hidden</strong>(bool):- Whether to include hidden groups in results. Default: false.
                </li>
                <li>
                    <strong>page_arg</strong>(string):- Query argument used for pagination. Default: 'grpage'.
                </li>
                <li>
                    <strong>slug</strong>(string):- If provided, only the group with the matching slug will be returned. Default: false.
                </li>
                <li>
                    <strong>include</strong>(int|string):- Array or comma-separated list of group IDs. Results will be limited to groups within the list. Default: false.
                </li>
                <li>
                    <strong>exclude</strong>(int|string):- Array or comma-separated list of group IDs. Results will exclude the listed groups. Default: false.
                </li>
                <li>
                    <strong>user_id</strong>(int):- If provided, results will be limited to groups of which the specified user is a member. Default: value of bp_displayed_user_id().
                </li>
                <li>
                    <strong>group_type</strong>(array|string):- Array or comma-separated list of group types to limit results to.
                </li>
                <li>
                    <strong>member_type__in</strong> (array|string):- Array or comma-separated list of group types to limit results to.
                </li>
                <li>
                    <strong>member_type__not_in</strong> (array|string):- Array or comma-separated list of group types that will be excluded from results.
                </li>
                <li>
                    <strong>search_terms</strong> (string):- If provided, only groups whose names or descriptions match the search terms will be returned. Default: value of `$_REQUEST['groups_search']` or `$_REQUEST['s']`, if present. Otherwise false.
                </li>
                <li>
                    <strong>meta_query</strong> (array):- An array of meta_query conditions.
                </li>
                <li>
                    <strong>parent_id</strong> (array|string):- Array or comma-separated list of group IDs. Results will include only child groups of the listed groups. Default: null.
                </li>
            </ul>
            <div class="bpsh-admin-shortcode">
                <h3>Examples:-</h3>

                <p><b>[groups-listing user_id=1]</b></p>

                <p><b>[groups-listing per_page=10]</b></p>

                <p><b>[groups-listing search_terms='awesome']</b></p>

                <p><b>[groups-listing exclude='47,50']</b></p>
            </div>
        </div>
        <p><b>Well guys, It’s up to you to explore the possibilities.</b></p>
    </div>
</div>