<?php
/*
超级炫酷吊炸天的PHP留言板

原版By-QQ-3220257676
修改By-QQ-2024659553

Fuxsto
Aria
*/
session_start();
$messages = [];
$messagesFile = 'messages.json';

// 读取现有留言
if (file_exists($messagesFile)) {
    $messages = json_decode(file_get_contents($messagesFile), true);
}

// 处理表单提交
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $qq = $_POST['qq'];
    $nickname = $_POST['nickname'];
    $message = $_POST['message'];

    $ip = $_SERVER['REMOTE_ADDR'];

    // 添加留言
    $messages[] = [
        'qq' => $qq,
        'nickname' => $nickname,
        'message' => $message,
        'ip' => $ip
    ];

    // 检查JSON编码
    $json = json_encode($messages);
    if (json_last_error() !== JSON_ERROR_NONE) {
        die("JSON编码错误: " . json_last_error_msg());
    }

    // 写入文件
    if (file_put_contents($messagesFile, $json) === false) {
        die("写入文件失败");
    }

    // 显示提交成功的弹窗
    echo '<script>alert("提交成功！");</script>';
}

function getMessageImageUrl($qq) {
    return "https://q1.qlogo.cn/g?b=qq&nk=$qq&s=100";
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>留言板</title>
    <link rel="icon" href="https://s21.ax1x.com/2024/08/03/pkjNAJA.jpg" type="image/jpeg">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="consolescript.js"></script>
    <script src="time.js"></script>
    <style>
        body {
            background-color: #f0f8ff;
            color: #333;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            font-family: Arial, sans-serif;
        }
        .message-card {
            border: 1px solid #007bff;
            border-radius: 16px;
            padding: 16px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            background-color: #007bff;
            color: #fff;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            opacity: 0;
            animation: flyIn 0.8s ease-in-out forwards;
            backdrop-filter: blur(10px);
            transition: transform 0.3s;
        }
        .message-card:hover {
            transform: scale(1.05);
        }
        .message-card img {
            border-radius: 50%;
            margin-right: 16px;
            width: 50px;
            height: 50px;
        }
        .message-card .content {
            flex: 1;
        }
        .form-container {
            background-color: #e3f2fd;
            padding: 20px;
            border-radius: 16px;
            margin-top: 32px;
            color: #333;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            opacity: 0;
            animation: fadeIn 1s ease-in-out forwards;
        }
        .form-container input,
        .form-container select,
        .form-container button {
            width: 100%;
            margin-bottom: 16px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 16px;
            box-sizing: border-box;
            outline: none;
        }
        .form-container input:focus,
        .form-container select:focus,
        .form-container button:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        .form-container select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTYiIGhlaWdodD0iOCIgdmlld0JveD0iMCAwIDE2IDgiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxwYXRoIGQ9Ik0xIDEuNDE1MTJMOC4wMDE4MSA3TDE1IDMuMTQxNTIiIHN0cm9rZT0iIzAwM0ZGRiIgc3Ryb2tlLXdpZHRoPSIxLjUiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIvPgo8L3N2Zz4K') no-repeat right 10px center;
            background-color: #fff;
            background-size: 10px;
        }
        .form-container button {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .form-container button:hover {
            background-color: #0056b3;
        }
        @keyframes flyIn {
            0% {
                transform: translateX(var(--translateX)) translateY(var(--translateY));
                opacity: 0;
            }
            100% {
                transform: translateX(0) translateY(0);
                opacity: 1;
            }
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        .github-link {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
            display: flex;
            align-items: center;
            max-width: 200px; /* 设置最大宽度 */
            overflow: hidden; /* 防止内容溢出 */
            text-overflow: ellipsis; /* 超出部分显示省略号 */
            white-space: nowrap; /* 不换行 */
        }
        .github-link img {
            width: 20px;
            height: 20px;
            margin-right: 5px;
        }
        .github-link:hover {
            background-color: #555;
        }
        .github-logo 
        {
             display: block;
             margin: 0 auto; /* 这将使元素在水平方向上居中 */
        }

        /* 毛玻璃效果 */
        .bg-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('https://s21.ax1x.com/2024/08/05/pkvYTij.jpg'); /* 新的背景图片URL */
            background-size: cover;
            background-position: center;
            backdrop-filter: blur(10px);
            z-index: -1;
        }

        /* 页面内容 */
        .content-wrapper {
            position: relative;
            z-index: 1;
        }

        /* 加载动画 */
        .loading-overlay {
            /* 设置加载层的位置为固定，覆盖整个页面 */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /* 设置加载层的背景颜色为半透明的白色 */
            background-color: rgba(255, 255, 255, 1);
            /* 设置加载层的内容居中显示 */
            display: flex;
            justify-content: center;
            align-items: center;
            /* 设置加载层的层级为9999，保证在最上层显示 */
            z-index: 9999;
        }
        .loading-spinner {
            /* 设置加载动画的边框为8px的实线，颜色为#f3f3f3 */
            border: 8px solid #f3f3f3;
            /* 设置加载动画的上边框为8px的实线，颜色为#3498db */
            border-top: 8px solid #3498db;
            /* 设置加载动画的边框为圆形 */
            border-radius: 50%;
            /* 设置加载动画的宽度为60px */
            width: 60px;
            /* 设置加载动画的高度为60px */
            height: 60px;
            /* 设置加载动画的动画名称为spin，持续时间为2s，线性运动，无限循环 */
            animation: spin 2s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* 防止滚动 */
        body.no-scroll {
            overflow: hidden;
        }

        .copyright {
            color: blue; /* 设置文字颜色为白色 */
        }
        .container a {
            color: blue; /* 设置链接颜色为白色 */
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="loading-overlay" id="loading-overlay">
        <div class="loading-spinner"></div>
    </div>
    <div class="bg-overlay"></div>
    <div class="content-wrapper">
        <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-center text-white mb-6">留言板</h1>


            <div id="messages" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php foreach ($messages as $index => $msg): ?>
                    <div class="message-card" style="--translateX: <?= rand(-80, 80) ?>px; --translateY: <?= rand(-1000, 1000) ?>px; animation-delay: <?= $index * 0.1 ?>s;">
                        <img src="<?= getMessageImageUrl($msg['qq']) ?>" alt="Avatar">
                        <div class="content">
                            <strong><?= htmlspecialchars($msg['nickname']) ?></strong>
                            <p><?= htmlspecialchars($msg['message']) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="form-container" id="form-container" style="animation-delay: <?= count($messages) * 0.1 ?>s;">
                <form method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="qq">
                            QQ号
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="qq" type="text" name="qq" placeholder="QQ号" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="nickname">
                            昵称
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nickname" type="text" name="nickname" placeholder="昵称" required>
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 font-bold mb-2" for="message">
                            留言
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="message" type="text" name="message" placeholder="请输入留言" required></input>
                    </div>
                    <div class="flex items-center justify-between">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                            添加留言
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const loadingOverlay = document.getElementById('loading-overlay');
            setTimeout(() => {
                loadingOverlay.style.display = 'none';
                document.body.classList.remove('no-scroll');
            }, 1000); // 1秒后隐藏加载动画
            document.body.classList.add('no-scroll');
        });
    </script>

    <footer class="text-center mt-10">
        <div class="copyright">
            <p>本站已运行 <span id="runtime"></span></p>
            <p>修改By-QQ-2024659553</p>
        </div>
        <div class="container">
             <a href="https://github.com/FurryAria/PHP-Messages" target="_blank">GITHUB仓库</a>
        </div>
    </footer>
</body>
</html>