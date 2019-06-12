<?php
use yii\helpers\Html;
use yii\web\View;
use yii\bootstrap;

$this->registerCssFile('/css/show.css');
?>

<div class="article-block">
    <div class="article-title">
        专家评课记录表
    </div>
    <div class="article-content">
        <table class="gridtable">
            <tr>
                <td>科目</td>
                <td>语文</td>
                <td>授课人</td>
                <td>饶可旋</td>
                <td>课题</td>
                <td>《长城》</td>
            </tr>
            <tr>
                <td>授课班级</td>
                <td>401</td>
                <td>授课时间</td>
                <td>12月3日</td>
                <td>整理人</td>
                <td>饶可旋</td>
            </tr>
            <tr>
                <td>评课人</td>
                <td colspan="5">刘婉丽博士</td>
            </tr>
            <tr>
                <td>评课要点记录</td>
                <td colspan="5" class="evaluate-content">
                    <p>优点：</p>
                    <p>1.整个教学的设计思路清晰，起到了较好的提纲挈领作用。</p>
                    <p>2.教师能面向全体学生，激发学生的深层思考和情感投入，鼓励学生大胆质疑、独立思考。</p>
                    <p>3.教师能按照课程标准和教学内容的体系进行有序教学，完成知识、技能等基础性目标，同时还要注意学生发展性目标的实现。</p>
                    <p>4.教师对学生的激励既不形式化，又具体、诚恳。对于学生出现的错误，能及时以恰当的方式指出纠正。</p>

                    <p>建议：</p>
                    <p>1.教学教师要利用课堂生成资源，有选择地抓住与教学密切相关的点进行联系和发挥，教师和学生都会有意想不到的收获。</p>
                    <p>2.老师在课堂中应当扮演组织者、引导者和合作者的角色，不是传授即时方法，而是教给学生解决问题的策略。</p>
                    <p>3.要突出精讲精练，教学方法要灵活多样，应变调控课堂能力强要加强。</p>
                </td>
            </tr>

        </table>
    </div>
</div>