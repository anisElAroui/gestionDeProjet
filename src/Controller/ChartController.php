<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 09/05/18
 * Time: 10:02
 */

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\Material\ColumnChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;

class ChartController extends Controller
{

    /**
     * @Route("project/charts", name="chart_index")
     * @Method({"GET"})
     */
    public function indexAction()
    {
        $done = 0;
        $total = 0;
        $late = 0;

        $dm = $this->get('doctrine_mongodb')->getManager();
        $projects = $dm->getRepository('App\Document\Project')->findAll();
        foreach ($projects as $project){
                $total=$total+1;
            if ($project->getDone() === 1.0){
                $done=$done+1;
            }
            if ($project->getEndDate() > $project->getPlannedEndDate() ){
                $late=$late+1;
            }
        }
        $pieChart = new PieChart();
        $pieChart->getData()->setArrayToDataTable(
            [
                ['Status', 'validated (by unit)'],
                ['Finish',  $done],
                ['In progress',  $total-$done]
            ]
        );
        $pieChart->getOptions()->setTitle('Status of projects');
//        $pieChart->getOptions()->setPieSliceText('label');
        $pieChart->getOptions()->setColors(['#1b9e77', '#d95f02']);
        $pieChart->getOptions()->setPieHole(0.4);
        $pieChart->getOptions()->setPieStartAngle(100);
        $pieChart->getOptions()->setWidth(600);
        $pieChart->getOptions()->setHeight(500);

        $pc = new PieChart();
        $pc->getData()->setArrayToDataTable(
            [
                ['Status', 'validated (by unit)'],
                ['In time',  $total-$done-$late],
                ['Late',  $late]
            ]
        );
        $pc->getOptions()->setTitle('Status of projects In progress');
        $pc->getOptions()->setIs3D(true);
        $pc->getOptions()->setPieStartAngle(100);
        $pc->getOptions()->setWidth(600);
        $pc->getOptions()->setHeight(500);

        $col = new ColumnChart();
            $col->getData()->setArrayToDataTable(
                [
                    ['Project name', 'Budget', 'Expenses'],
                ]
            );
//        foreach ( $projects as $project) {
//            data.addRow(['A', 123, 40]);
//            [$project->getProjectName(), 4000, $project->getExpenses()]
//        }


        $col->getOptions()
            ->setTitle('Budget/Expenses By project')
            ->setWidth(1200)
            ->setHeight(500);
        $col->getOptions()
            ->getAnnotations()
            ->setAlwaysOutside(true)
            ->getTextStyle()
            ->setAuraColor('none')
            ->setFontSize(14)
            ->setColor('#000');
        $col->getOptions()
            ->getHAxis()
            ->setTitle('Project name')
            ->getViewWindow();
        $col->getOptions()
            ->getVAxis()
            ->setTitle('Money (Million)');

        $column = new ColumnChart();
        $column->getData()->setArrayToDataTable(
            [
                ['Year', 'Budget', 'Expenses'],
                ['2015', 2000, 500],
                ['2016', 2000, 500],
                ['2017', 2000, 500],
                ['2018', 3000, 200]
            ]
        );
        $column->getOptions()
            ->setTitle('Budget/Expenses By year')
            ->setWidth(1200)
            ->setHeight(500)
            ->setColors(['blue','red']);
        $column->getOptions()
            ->getAnnotations()
            ->setAlwaysOutside(true)
            ->getTextStyle()
            ->setAuraColor('none')
            ->setFontSize(14)
            ->setColor('#000');
        $column->getOptions()
            ->getHAxis()
            ->setTitle('Year')
            ->getViewWindow();
        $column->getOptions()
            ->getVAxis()
            ->setTitle('Money (Million)');

        return $this->render('Chart/index.html.twig', array('piechart' => $pieChart,'pie' => $pc, 'col' => $col,'column' => $column));
    }

}