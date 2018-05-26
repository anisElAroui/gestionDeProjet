<?php

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
    public function indexAction(){
        return $this->render('Chart/index.html.twig');
    }

    public function pieAction()
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

        return $this->render('Chart/pie.html.twig', array('piechart' => $pieChart,'pie' => $pc));
    }

    public function colAction(){

        $col = new ColumnChart();
        $dm = $this->get('doctrine_mongodb')->getManager();
        $projects = $dm->getRepository('App\Document\Project')->findAll();
        $array = array();
        $array[] = ['Project name', 'Budget', 'Expenses'];
        foreach ( $projects as $project) {
            $array[] = [$project->getProjectName(), $project->getBudget(), $project->getExpenses()];
        }

        $col->getData()->setArrayToDataTable(
            $array
        );

        $col->getOptions()
            ->setTitle('Budget/Expenses By project')
            ->setWidth(1150)
            ->setHeight(500);
        $col->getOptions()
            ->getHAxis()
            ->setTitle('Project name')
            ->getViewWindow();
        $col->getOptions()
            ->getVAxis()
            ->setTitle('Money (Million)');

        return $this->render('Chart/col.html.twig', array('col' => $col));
    }

    public function columnAction(){

        $column = new ColumnChart();
        $array = array();
        $array[] = ['Year', 'Budget', 'Expenses'];
        $expenses2018 = 0;
        $budget2018 = 0;
        $expenses2017 = 0;
        $budget2017 = 0;
        $expenses2016 = 0;
        $budget2016 = 0;
        $dm = $this->get('doctrine_mongodb')->getManager();
        $projects = $dm->getRepository('App\Document\Project')->findAll();
        foreach ( $projects as $project) {
            if ($project->getRealStartDate() !== null){
                if (strpos( $project->getRealStartDate()->format('Y-m-d'), "2018") !== false){
                    $expenses2018 = $expenses2018 + $project->getExpenses();
                    $budget2018 = $budget2018 + $project->getBudget();
                }
                if (strpos( $project->getRealStartDate()->format('Y-m-d'), "2017") !== false){
                    $expenses2017 = $expenses2017 + $project->getExpenses();
                    $budget2017 = $budget2017 + $project->getBudget();
                }
                if (strpos( $project->getRealStartDate()->format('Y-m-d'), "2016") !== false){
                    $expenses2016 = $expenses2016 + $project->getExpenses();
                    $budget2016 = $budget2016 + $project->getBudget();
                }
            }
        }

        $array[] = ['2016', $budget2016, $expenses2016];
        $array[] = ['2017', $budget2017, $expenses2017];
        $array[] = ['2018', $budget2018, $expenses2018];

        $column->getData()->setArrayToDataTable(
            $array
        );
        $column->getOptions()
            ->setTitle('Budget/Expenses By year')
            ->setWidth(1150)
            ->setHeight(500)
            ->setColors(['blue','red']);
        $column->getOptions()
            ->getHAxis()
            ->setTitle('Year')
            ->getViewWindow();
        $column->getOptions()
            ->getVAxis()
            ->setTitle('Money (Million)');

        return $this->render('Chart/column.html.twig', array('column' => $column));
    }

}