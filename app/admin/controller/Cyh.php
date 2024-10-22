<?php
declare(strict_types=1);

namespace app\admin\controller;

use think\admin\Controller;
use think\admin\helper\QueryHelper;
use think\admin\model\SystemCyh;

/**
 * 测试增加菜单
 * @class Cyh
 * @package app\admin\controller
 */

class Cyh extends Controller
{
    /**
     * 测试增加菜单
     * @auth true
     * @menu true
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    //注释中没有设置@menu true
    public function index()
    {
        SystemCyh::mQuery()->layTable(function () {
            $this->title = '测试增加菜单';
            $this->types = SystemCyh::types();
            $this->how = $this->get['how'] ?? ($this->types[0] ?? '-');
        }, static function (QueryHelper $query) {
            $query->where(['deleted' => 0])->equal('how');
            $query->like('mid,name,address,status')->dateBetween('create_at');
            //var_dump($query->buildSql());
        });

    }

    /**
     * 添加
     * @auth true
     */
    public function add()
    {
        SystemCyh::mForm('form');
    }

    /**
     * 编辑
     * @auth true
     */
    public function edit()
    {
        SystemCyh::mForm('form');
    }

    /**
     * 表单数据处理
     * @param array $data
     * @throws \think\db\exception\DbException
     */
    protected function _form_filter(array &$data)
    {
        if ($this->request->isGet()) {
            $this->types = SystemCyh::types();
            $this->types[] = '--- ' . lang('新渠道') . ' ---';
            $this->type = $this->get['how'] ?? ($this->types[0] ?? '-');
        } else {
            $map = [];
            $map[] = ['deleted', '=', 0];
            $map[] = ['how', '=', $data['how']];
            $map[] = ['mid', '=', $data['mid']];
            $map[] = ['id', '<>', $data['id'] ?? 0];
            if (SystemCyh::mk()->where($map)->count() > 0) {
                $this->error("该渠道该会员已经存在！");
            }
        }
    }

    /**
     * 修改数据状态
     * @auth true
     */
    public function state()
    {
        SystemCyh::mSave($this->_vali([
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
        SystemCyh::mDelete();
    }
}