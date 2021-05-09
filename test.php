<?php
namespace Taskforce\models;
require(__DIR__ . '/vendor/autoload.php');


print "<b>Possible actions</b> <br>";

$task_status_new = new Task(1,2,'new');
print 'New: ';
if (assert($task_status_new->getPossibleActions() == ['Respond','Cancel'])) {
    print 'good';
} else {
    print 'fail';
}
print '<br>';

$task_status_working = new Task(1,2,'working');
print 'Working: ';
if (assert($task_status_working->getPossibleActions() == ['Failure','Finish'])) {
    print 'good';
} else {
    print 'fail';
}
print '<br><br>';

$task_actions = new Task(1,2,'new');
print "<b>Next status</b> <br>";

print Task::ACTION_RESPOND . ': ';
if (assert($task_actions->getNextStatus(Task::ACTION_RESPOND) == Task::STATUS_WORKING) ) {
    print 'good';
} else {
    print 'fail';
}
print '<br>';

print Task::ACTION_CANCEL . ': ';
if (assert($task_actions->getNextStatus(Task::ACTION_CANCEL) == Task::STATUS_CANCELED) ) {
    print 'good';
} else {
    print 'fail';
}
print '<br>';

print Task::ACTION_FAILURE . ': ';
if (assert($task_actions->getNextStatus(Task::ACTION_FAILURE) == Task::STATUS_FAIL) ) {
    print 'good';
} else {
    print 'fail';
}
print '<br>';

print Task::ACTION_FINISH . ': ';
if (assert($task_actions->getNextStatus(Task::ACTION_FINISH) == Task::STATUS_COMPLETE) ) {
    print 'good';
} else {
    print 'fail';
}
print '<br>';
