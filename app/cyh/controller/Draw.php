<?php
declare(strict_types=1);

namespace app\cyh\controller;

use think\admin\Controller;
use think\admin\helper\QueryHelper;
use app\cyh\model\NewServerDrawList;

/**
 * 开新服2024
 * @class Cyh
 * @package app\admin\controller
 */

class Draw extends Controller
{
    /**
     * 开新服2024
     * @auth true
     * @menu true
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function index()
    {
        NewServerDrawList::mQuery()->layTable(
            //第一个回调函数：页面和数据初始化
            function () {
            /*
              设置页面标题：$this->title = '数据字典管理' 用于给页面设置一个标题，表示当前页面是“数据字典管理”。
              初始化类型列表：$this->types = SystemBase::types(); 通过调用 SystemBase::types() 方法获取所有的数据类型，可能是从数据库或配置文件中读取。
              获取查询条件：$this->type = $this->get['type'] ?? ($this->types[0] ?? '-'); 通过 URL 中的 type 参数来确定当前要筛选的数据字典类型，如果没有提供 type 参数，则使用默认的第一个类型。
             */
            $this->title = '开新服2024';
            $this->types = NewServerDrawList::types();
            $this->goods_name = $this->get['goods_name'] ?? ($this->types[0] ?? '-');
        },
            //第二个回调函数：查询条件构建
            static function (QueryHelper $query) {
                /*
                这个静态回调函数用于构建数据库查询条件，主要是为数据表格展示的数据进行筛选和过滤：
                where(['deleted' => 0])：只查询 deleted 字段为 0 的数据，这通常意味着只查询未被删除的数据。
                equal('type')：根据前面初始化时确定的 type 字段值，筛选出对应类型的数据字典项。
                like('code,name,status')：对 code、name 和 status 进行模糊查询，允许用户通过这些字段进行搜索。
                dateBetween('create_at')：根据 create_at（创建时间）字段，进行时间范围的过滤，通常用于展示一定时间段内的数据。
                这个回调函数的作用是定义如何从数据库中获取符合条件的数据，构建 SQL 查询语句。
               */
            $query->where(['deleted' => 0])->equal('goods_name'); //这个equal主要是为导航栏的小类别服务的
            $query->like('mid,goods_name,ip,status')->dateBetween('add_time');  //允许用户搜索的字段，这里缺对应字段就不能搜索
            //var_dump($query->buildSql());
        }
        );

    }

    /**
     * 添加
     * @auth true
     */
    public function add()
    {
        NewServerDrawList::mForm('form');
    }

    /**
     * 编辑
     * @auth true
     */
    public function edit()
    {
        NewServerDrawList::mForm('form');
    }

    /**
     * 表单数据处理
     * @param array $data
     * @throws \think\db\exception\DbException
     */
    protected function _form_filter(array &$data)
    {
        if ($this->request->isGet()) {
            $this->types = NewServerDrawList::types();
            $this->types[] = '--- ' . lang('新的奖励') . ' ---';
            //$this->type = $this->get['how'] ?? ($this->types[0] ?? '-');
        } else {
            //如果是POST方式，这里筛选是否有同样数据，或者自定义实现其他的功能
            $map = [];
            $map[] = ['deleted', '=', 0];
            $map[] = ['add_time', '=', date('Y-m-d H:i:s')];
            $map[] = ['mid', '=', $data['mid']];
            $map[] = ['goods_name', '=', $data['goods_name']];
            $map[] = ['id', '<>', $data['id'] ?? 0];
            if (NewServerDrawList::mk()->where($map)->count() > 0) {
                $this->error("该会员已经存在！");
            }
        }
    }

    /**
     * 修改数据状态
     * @auth true
     */
    public function state()
    {
        NewServerDrawList::mSave($this->_vali([
            'status.in:0,1'  => '状态值范围异常！',
            'status.require' => '状态值不能为空！',
        ]));
    }

    /**
     * 删除
     * @auth true
     */
    public function remove()
    {
        NewServerDrawList::mDelete();
    }
}