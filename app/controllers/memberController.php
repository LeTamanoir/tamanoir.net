<?php
namespace controllers; 
use models\memberModel;
use models\discussionModel;

class memberController
{
    public function displayMembers ($discussionID,$userID) {
        $discussionModel = new discussionModel();
        $memberModel = new memberModel();
        $discussions = $discussionModel->getDiscussions($userID);
        $check = $discussionModel->checkUserInDiscussion($discussionID,$userID);
        if ($check) {
            $members = $memberModel->getMembers($discussionID);
            return $members;
        }
    }

    public function addMember ($discussionID,$member,$userID) {
        $discussionModel = new discussionModel();
        $memberModel = new memberModel();
        $discussions = $discussionModel->getDiscussions($userID);
        $check = $discussionModel->checkUserInDiscussion($discussionID,$userID);
        if ($check) {
            $user = $memberModel->getMemberID($member);
            if ($user) {
                $userCheck = $discussionModel->checkUserInDiscussion($discussionID,$user);
                if ($userCheck) {
                    return ["info" => "user already in group"];
                }
                else {
                    $memberModel->addMember($user,$discussionID);
                    return ["info" => "success"];
                }
            }
            else {
                return ["info" => "user not found"];
            }
        }
    }

    public function delMember ($discussionID,$member,$userID) {
        $memberModel = new memberModel();
        $discussionModel = new discussionModel();
        $check = $discussionModel->checkUserInDiscussion($discussionID,$userID);
        if ($check) {
            $checkMember = $discussionModel->checkUserInDiscussion($discussionID,$member);
            if ($checkMember) {
                $checkCreator = $discussionModel->getDiscussionCreator($discussionID);
                if ($checkCreator['creator_id'] === $userID) {
                    $memberModel->delMember($discussionID,$member);
                }
            }
        }
    }
}
