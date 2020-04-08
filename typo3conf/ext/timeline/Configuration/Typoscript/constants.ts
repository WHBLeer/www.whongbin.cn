plugin.tx_timeline_pi1 {
    settings {
        # cat=tx_timeline_pi1/enable/a; type=boolean; label=Include JQuery: 引入jQuery
        jquery = 0

        # cat=tx_timeline_pi1/style/a; type=options[Layout 1, Layout 2, Layout 3]; label=风格: 时间轴风格
        layout = Layout 1

        # cat=tx_timeline_pi1/style/b; type=boolean; label=年份: 仅显示事件的年份
        year = 0

        # cat=tx_timeline_pi1/color/a; type=color; label=背景颜色:时间轴背景颜色
        fore_color = #fff

        # cat=tx_timeline_pi1/other/a; type=options[asc, desc, none]; label=排序:时间轴项目的顺序
        order = desc

        # cat=tx_timeline_pi1/file/a; type=string; label=自定义样式: 引入自定义样式
        customCSS = 
    }
}
