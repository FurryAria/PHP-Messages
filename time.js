        // 设置初始日期为2024年8月4日，北京时间
        var initialDate = new Date('2024-08-04T00:00:00+08:00');

        // 计算并更新运行时间
        function calculateRuntime() {
            var now = new Date().getTime();
            var elapsed = now - initialDate.getTime();
            var days = Math.floor(elapsed / (1000 * 60 * 60 * 24));
            var hours = Math.floor((elapsed % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((elapsed % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((elapsed % (1000 * 60)) / 1000);

            return days + " 天 " + hours + " 小时 " + minutes + " 分钟 " + seconds + " 秒";
        }

        // 每秒更新一次运行时间
        setInterval(function() {
            document.getElementById('runtime').innerText = calculateRuntime();
        }, 1000);