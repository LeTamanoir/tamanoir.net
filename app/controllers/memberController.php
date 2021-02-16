<?php
namespace controllers; 
use models\memberModel;
use models\messageModel;

class memberController
{
    public function displayMembers ($discussionID,$userID) {
        $messageModel = new messageModel();
        $memberModel = new memberModel();
        $discussions = $messageModel->getDiscussions($userID);
        $check = $messageModel->checkUserInDiscussion($discussionID,$userID);
        if ($check) {
            $members = $memberModel->getMembers($discussionID);
            return $members;
        }
    }

    public function addMember ($discussionID,$member,$userID) {
        $messageModel = new messageModel();
        $memberModel = new memberModel();
        $discussions = $messageModel->getDiscussions($userID);
        $check = $messageModel->checkUserInDiscussion($discussionID,$userID);
        if ($check) {
            $user = $memberModel->getMemberID($member);
            if ($user) {
                $userCheck = $messageModel->checkUserInDiscussion($discussionID,$user);
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
        $messageModel = new messageModel();
        $check = $messageModel->checkUserInDiscussion($discussionID,$userID);
        if ($check) {
            $checkMember = $messageModel->checkUserInDiscussion($discussionID,$member);
            if ($checkMember) {
                $checkCreator = $messageModel->getDiscussionCreator($discussionID);
                if ($checkCreator['creator_id'] === $userID) {
                    $memberModel->delMember($discussionID,$member);
                }
            }
        }
    }
}
