<?php
/**
 * This file is part of the "dragon-code/pretty-routes" project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Andrey Helldar <helldar@dragon-code.pro>
 * @copyright 2024 Andrey Helldar
 * @license MIT
 *
 * @see https://github.com/TheDragonCode/pretty-routes
 */

namespace Tests\Localizations;

use Tests\TestCase;

class ZhCnTest extends TestCase
{
    public function testApp()
    {
        $this->setConfigLocale('zh_CN');

        $response = $this->get('/routes');

        $response->assertStatus(200);

        $response->assertSee('动作');
        $response->assertSee('全部');
        $response->assertSee('全部数量');
        $response->assertSee('接口');
        $response->assertSee('清除路由缓存');
        $response->assertSee('废弃的');
        $response->assertSee('域名');
        $response->assertSee('加载中... 请稍候...');
        $response->assertSee('方法');
        $response->assertSee('中间件');
        $response->assertSee('模块');
        $response->assertSee('名称');
        $response->assertSee('暂无数据');
        $response->assertSee('没有找到相关记录');
        $response->assertSee('的');
        $response->assertSee('只有');
        $response->assertSee('在 GitHub 上打开项目页面');
        $response->assertSee('路径');
        $response->assertSee('优先顺序');
        $response->assertSee('刷新路由列表');
        $response->assertSee('路由类型');
        $response->assertSee('每页显示的路由数量');
        $response->assertSee('路由');
        $response->assertSee('搜索');
        $response->assertSee('显示');
        $response->assertSee('网页');
        $response->assertSee('没有');

        $response->assertSee('{0}-{1} 共 {2}');

        $response->assertDontSee('Foo Bar');
        $response->assertDontSee('Записей на странице');
    }

    public function testPackage()
    {
        $this->setConfigLocale('en', 'zh_CN');

        $response = $this->get('/routes');

        $response->assertStatus(200);

        $response->assertSee('动作');
        $response->assertSee('全部');
        $response->assertSee('全部数量');
        $response->assertSee('接口');
        $response->assertSee('清除路由缓存');
        $response->assertSee('废弃的');
        $response->assertSee('域名');
        $response->assertSee('加载中... 请稍候...');
        $response->assertSee('方法');
        $response->assertSee('中间件');
        $response->assertSee('模块');
        $response->assertSee('名称');
        $response->assertSee('暂无数据');
        $response->assertSee('没有找到相关记录');
        $response->assertSee('的');
        $response->assertSee('只有');
        $response->assertSee('在 GitHub 上打开项目页面');
        $response->assertSee('路径');
        $response->assertSee('优先顺序');
        $response->assertSee('刷新路由列表');
        $response->assertSee('路由类型');
        $response->assertSee('每页显示的路由数量');
        $response->assertSee('路由');
        $response->assertSee('搜索');
        $response->assertSee('显示');
        $response->assertSee('网页');
        $response->assertSee('没有');

        $response->assertSee('{0}-{1} 共 {2}');

        $response->assertDontSee('Foo Bar');
        $response->assertDontSee('Записей на странице');
    }

    public function testIncorrect()
    {
        $this->setConfigLocale('en', 'foo');

        $response = $this->get('/routes');

        $response->assertStatus(200);

        $response->assertSee('Action');
        $response->assertSee('All');
        $response->assertSee('All');
        $response->assertSee('Api');
        $response->assertSee('Clear route cache');
        $response->assertSee('Deprecated');
        $response->assertSee('Domain');
        $response->assertSee('Loading... Please wait...');
        $response->assertSee('Methods');
        $response->assertSee('Middlewares');
        $response->assertSee('Module');
        $response->assertSee('Name');
        $response->assertSee('No data available');
        $response->assertSee('No matching records found');
        $response->assertSee('of');
        $response->assertSee('Only');
        $response->assertSee('Open the project page on GitHub');
        $response->assertSee('Path');
        $response->assertSee('Priority');
        $response->assertSee('Refresh the list of routes');
        $response->assertSee('Route types');
        $response->assertSee('Routes per page');
        $response->assertSee('Routes');
        $response->assertSee('Search');
        $response->assertSee('Show');
        $response->assertSee('Web');
        $response->assertSee('Without');

        $response->assertSee('{0}-{1} of {2}');

        $response->assertDontSee('Foo Bar');
        $response->assertDontSee('Записей на странице');
    }
}
