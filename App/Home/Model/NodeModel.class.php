<?php
namespace Home\Model;
use Think\Model;
class NodeModel extends Model{
	protected $_validate = array(
		array('name','require','节点名称必须！'), //默认情况下用正则进行验证
		array('name','require','节点描述必须！'), //默认情况下用正则进行验证
		array('status','require','状态必须！'), //默认情况下用正则进行验证
// 		array('name','','角色名已经存在！',0,'unique',Model:: MODEL_BOTH), // 在新增的时候验证name字段是否唯一
	);
}
?>