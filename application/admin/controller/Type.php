<?php 
namespace app\admin\controller;

use think\Controller;
use think\Db;

class Type extends Controller{
	public function intype($flname,$pid)
	{	
		if($flname != '' && $pid != 0){
			$where = [
				'id' => ['eq',"$pid"]
			];
			$m =Db::table('xiaomi_type')->where($where)->find();
			
			// $where2 = [
			// 	'pid' => ['eq',"$m[id]"]
			// ];
			// $c =Db::table('xiaomi_type')->where($where2)->order('path','desc')->find();

			//dump($c['path'].'.'.'1');
			$data = [
				'name' => "$flname",
				'pid' => "$pid",
				'path' => $m['path'],
				'level' => substr_count($m['path'],'.')
			];

			$userId = Db::table('xiaomi_type')->insertGetId($data);

			$where3 = [
				'id' => ['eq',"$userId"]
			];
			$getIdRes = Db::table('xiaomi_type')->where($where3)->find();

			$cl = $m['path'].".".$getIdRes['id'];
			$update = [
				'path' => "$cl"
			];
			$updateRes = Db::table('xiaomi_type')->where($where3)->update($update);

			$levelSelect = Db::table('xiaomi_type')->where($where3)->find();
			$levelUpdate = [
				'level' => substr_count($levelSelect['path'],'.')
			];
			$levelUpdateRes = Db::table('xiaomi_type')->where($where3)->update($levelUpdate);

			if($levelUpdateRes){
				return json(['code'=>'1','data'=>'','msg'=>'添加成功！']);
			}else{
				return json(['code'=>'-1','data'=>'','msg'=>'添加失败']);
			}
		}

		if($pid == 1){
			$where = [
				'pid' => ['eq',$pid]
			];
			$m = Db::table('xiaomi_type')->where($where)->order('id','desc')->find();
			$number = $m['path']+0.1;
			if($number == 1 || $number == 2 || $number == 3 || $number == 4 || $number == 5 || $number == 6 || $number == 7 || $number == 8 || $number == 9 || $number == 10){
				$number = '1.0';
			}
		
			$insert = [
				'name' => $flname,
				'pid' => $pid,
				'path' => $number,
				'level' => substr_count($number,'.')
			];
			$insertType = Db::table('xiaomi_type')->where($where)->insert($insert);

			if($insertType){
				return json(['code'=>'1','data'=>'','msg'=>'添加成功！']);
			}else{
				return json(['code'=>'-1','data'=>'','msg'=>'添加失败！']);
			}
		}
	}

	public function typed()
	{
		$params = input('param.');
		$where = [
			'pid' => ['eq',$params['id']]
		];
		$db = Db::table('xiaomi_type')->where($where)->select();
		$pidNum = count($db);

		if($pidNum == 0){
			$where2 =[
				'id' => ['eq',$params['id']]
			];
			$dbd = Db::table('xiaomi_type')->where($where2)->delete();
			if($dbd){
				return json(['code'=>'1','data'=>'','msg'=>'删除成功！']);
			}else{
				return json(['code'=>'-1','data'=>'','msg'=>'删除失败！']);
			}
		}else{
			return json(['code'=>'-1','data'=>'','msg'=>'删除失败！还有下级分类不能删除，请先删除下级']);
		}
	}
}