<?php
/**
 * This helper builds the request body for a /mail/send API call.
 *
 * PHP version 5.3
 *
 * @author    Elmer Thomas <dx@sendgrid.com>
 * @copyright 2016 SendGrid
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @version   GIT: <git_id>
 * @link      http://packagist.org/packages/sendgrid/sendgrid
 */
namespace SendGrid;

class ReplyTo implements \JsonSerializable
{
    private
        $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'email' => $this->getEmail()
            ]
        );
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
}

class ClickTracking implements \JsonSerializable
{
    private
        $enable,
        $enable_text;

    public function setEnableText($enable_text)
    {
        $this->enable_text = $enable_text;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'enable' => $this->getEnable(),
                'enable_text' => $this->getEnableText()
            ]
        );
    }

    public function getEnable()
    {
        return $this->enable;
    }

    public function setEnable($enable)
    {
        $this->enable = $enable;
    }

    public function getEnableText()
    {
        return $this->enable_text;
    }
}

class OpenTracking implements \JsonSerializable
{
    private
        $enable,
        $substitution_tag;

    public function setSubstitutionTag($substitution_tag)
    {
        $this->substitution_tag = $substitution_tag;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'enable' => $this->getEnable(),
                'substitution_tag' => $this->getSubstitutionTag()
            ]
        );
    }

    public function getEnable()
    {
        return $this->enable;
    }

    public function setEnable($enable)
    {
        $this->enable = $enable;
    }

    public function getSubstitutionTag()
    {
        return $this->substitution_tag;
    }
}

class SubscriptionTracking implements \JsonSerializable
{
    private
        $enable,
        $text,
        $html,
        $substitution_tag;

    public function setText($text)
    {
        $this->text = $text;
    }

    public function setHtml($html)
    {
        $this->html = $html;
    }

    public function setSubstitutionTag($substitution_tag)
    {
        $this->substitution_tag = $substitution_tag;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'enable' => $this->getEnable(),
                'text' => $this->getText(),
                'html' => $this->getHtml(),
                'substitution_tag' => $this->getSubstitutionTag()
            ]
        );
    }

    public function getEnable()
    {
        return $this->enable;
    }

    public function setEnable($enable)
    {
        $this->enable = $enable;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getHtml()
    {
        return $this->html;
    }

    public function getSubstitutionTag()
    {
        return $this->substitution_tag;
    }
}

class Ganalytics implements \JsonSerializable
{
    private
        $enable,
        $utm_source,
        $utm_medium,
        $utm_term,
        $utm_content,
        $utm_campaign;

    public function setCampaignSource($utm_source)
    {
        $this->utm_source = $utm_source;
    }

    public function setCampaignMedium($utm_medium)
    {
        $this->utm_medium = $utm_medium;
    }

    public function setCampaignTerm($utm_term)
    {
        $this->utm_term = $utm_term;
    }

    public function setCampaignContent($utm_content)
    {
        $this->utm_content = $utm_content;
    }

    public function setCampaignName($utm_campaign)
    {
        $this->utm_campaign = $utm_campaign;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'enable' => $this->getEnable(),
                'utm_source' => $this->getCampaignSource(),
                'utm_medium' => $this->getCampaignMedium(),
                'utm_term' => $this->getCampaignTerm(),
                'utm_content' => $this->getCampaignContent(),
                'utm_campaign' => $this->getCampaignName()
            ]
        );
    }

    public function getEnable()
    {
        return $this->enable;
    }

    public function setEnable($enable)
    {
        $this->enable = $enable;
    }

    public function getCampaignSource()
    {
        return $this->utm_source;
    }

    public function getCampaignMedium()
    {
        return $this->utm_medium;
    }

    public function getCampaignTerm()
    {
        return $this->utm_term;
    }

    public function getCampaignContent()
    {
        return $this->utm_content;
    }

    public function getCampaignName()
    {
        return $this->utm_campaign;
    }
}

class TrackingSettings implements \JsonSerializable
{
    private
        $click_tracking,
        $open_tracking,
        $subscription_tracking,
        $ganalytics;

    public function setOpenTracking($open_tracking)
    {
        $this->open_tracking = $open_tracking;
    }

    public function setSubscriptionTracking($subscription_tracking)
    {
        $this->subscription_tracking = $subscription_tracking;
    }

    public function setGanalytics($ganalytics)
    {
        $this->ganalytics = $ganalytics;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'click_tracking' => $this->getClickTracking(),
                'open_tracking' => $this->getOpenTracking(),
                'subscription_tracking' => $this->getSubscriptionTracking(),
                'ganalytics' => $this->getGanalytics()
            ]
        );
    }

    public function getClickTracking()
    {
        return $this->click_tracking;
    }

    public function setClickTracking($click_tracking)
    {
        $this->click_tracking = $click_tracking;
    }

    public function getOpenTracking()
    {
        return $this->open_tracking;
    }

    public function getSubscriptionTracking()
    {
        return $this->subscription_tracking;
    }

    public function getGanalytics()
    {
        return $this->ganalytics;
    }
}

class BccSettings implements \JsonSerializable
{
    private
        $enable,
        $email;

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'enable' => $this->getEnable(),
                'email' => $this->getEmail()
            ]
        );
    }

    public function getEnable()
    {
        return $this->enable;
    }

    public function setEnable($enable)
    {
        $this->enable = $enable;
    }

    public function getEmail()
    {
        return $this->email;
    }
}

class BypassListManagement implements \JsonSerializable
{
    private
        $enable;

    public function jsonSerialize()
    {
        return array_filter(
            [
                'enable' => $this->getEnable()
            ]
        );
    }

    public function getEnable()
    {
        return $this->enable;
    }

    public function setEnable($enable)
    {
        $this->enable = $enable;
    }
}

class Footer implements \JsonSerializable
{
    private
        $enable,
        $text,
        $html;

    public function setText($text)
    {
        $this->text = $text;
    }

    public function setHtml($html)
    {
        $this->html = $html;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'enable' => $this->getEnable(),
                'text' => $this->getText(),
                'html' => $this->getHtml()
            ]
        );
    }

    public function getEnable()
    {
        return $this->enable;
    }

    public function setEnable($enable)
    {
        $this->enable = $enable;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getHtml()
    {
        return $this->html;
    }
}

class SandBoxMode implements \JsonSerializable
{
    private
        $enable;

    public function jsonSerialize()
    {
        return array_filter(
            [
                'enable' => $this->getEnable()
            ]
        );
    }

    public function getEnable()
    {
        return $this->enable;
    }

    public function setEnable($enable)
    {
        $this->enable = $enable;
    }
}

class SpamCheck implements \JsonSerializable
{
    private
        $enable,
        $threshold,
        $post_to_url;

    public function setThreshold($threshold)
    {
        $this->threshold = $threshold;
    }

    public function setPostToUrl($post_to_url)
    {
        $this->post_to_url = $post_to_url;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'enable' => $this->getEnable(),
                'threshold' => $this->getThreshold(),
                'post_to_url' => $this->getPostToUrl()
            ]
        );
    }

    public function getEnable()
    {
        return $this->enable;
    }

    public function setEnable($enable)
    {
        $this->enable = $enable;
    }

    public function getThreshold()
    {
        return $this->threshold;
    }

    public function getPostToUrl()
    {
        return $this->post_to_url;
    }
}

class MailSettings implements \JsonSerializable
{
    private
        $bcc,
        $bypass_list_management,
        $footer,
        $sandbox_mode,
        $spam_check;

    public function setBccSettings($bcc)
    {
        $this->bcc = $bcc;
    }

    public function setBypassListManagement($bypass_list_management)
    {
        $this->bypass_list_management = $bypass_list_management;
    }

    public function setFooter($footer)
    {
        $this->footer = $footer;
    }

    public function setSandboxMode($sandbox_mode)
    {
        $this->sandbox_mode = $sandbox_mode;
    }

    public function setSpamCheck($spam_check)
    {
        $this->spam_check = $spam_check;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'bcc' => $this->getBccSettings(),
                'bypass_list_management' => $this->getBypassListManagement(),
                'footer' => $this->getFooter(),
                'sandbox_mode' => $this->getSandboxMode(),
                'spam_check' => $this->getSpamCheck()
            ]
        );
    }

    public function getBccSettings()
    {
        return $this->bcc;
    }

    public function getBypassListManagement()
    {
        return $this->bypass_list_management;
    }

    public function getFooter()
    {
        return $this->footer;
    }

    public function getSandboxMode()
    {
        return $this->sandbox_mode;
    }

    public function getSpamCheck()
    {
        return $this->spam_check;
    }
}

class ASM implements \JsonSerializable
{
    private
        $group_id,
        $groups_to_display;

    public function setGroupsToDisplay($group_ids)
    {
        $this->groups_to_display = $group_ids;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'group_id' => $this->getGroupId(),
                'groups_to_display' => $this->getGroupsToDisplay()
            ]
        );
    }

    public function getGroupId()
    {
        return $this->group_id;
    }

    public function setGroupId($group_id)
    {
        $this->group_id = $group_id;
    }

    public function getGroupsToDisplay()
    {
        return $this->groups_to_display;
    }
}

class Attachment implements \JsonSerializable
{
    private
        $content,
        $type,
        $filename,
        $disposition,
        $content_id;

    public function setType($type)
    {
        $this->type = $type;
    }

    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    public function setDisposition($disposition)
    {
        $this->disposition = $disposition;
    }

    public function setContentID($content_id)
    {
        $this->content_id = $content_id;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'content' => $this->getContent(),
                'type' => $this->getType(),
                'filename' => $this->getFilename(),
                'disposition' => $this->getDisposition(),
                'content_id' => $this->getContentID()
            ]
        );
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getFilename()
    {
        return $this->filename;
    }

    public function getDisposition()
    {
        return $this->disposition;
    }

    public function getContentID()
    {
        return $this->content_id;
    }
}

class Content implements \JsonSerializable
{
    private
        $type,
        $value;

    public function __construct($type, $value)
    {
        $this->type = $type;
        $this->value = $value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'type' => $this->getType(),
                'value' => $this->getValue()
            ]
        );
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getValue()
    {
        return $this->value;
    }
}

class Personalization implements \JsonSerializable
{
    private
        $tos,
        $ccs,
        $bccs,
        $subject,
        $headers,
        $substitutions,
        $custom_args,
        $send_at;

    public function addTo($email)
    {
        $this->tos[] = $email;
    }

    public function addCc($email)
    {
        $this->ccs[] = $email;
    }

    public function addBcc($email)
    {
        $this->bccs[] = $email;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function addHeader($key, $value)
    {
        $this->headers[$key] = $value;
    }

    public function addSubstitution($key, $value)
    {
        $this->substitutions[$key] = $value;
    }

    public function addCustomArg($key, $value)
    {
        $this->custom_args[$key] = $value;
    }

    public function setSendAt($send_at)
    {
        $this->send_at = $send_at;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'to' => $this->getTos(),
                'cc' => $this->getCcs(),
                'bcc' => $this->getBccs(),
                'subject' => $this->subject,
                'headers' => $this->getHeaders(),
                'substitutions' => $this->getSubstitutions(),
                'custom_args' => $this->getCustomArgs(),
                'send_at' => $this->getSendAt()
            ]
        );
    }

    public function getTos()
    {
        return $this->tos;
    }

    public function getCcs()
    {
        return $this->ccs;
    }

    public function getBccs()
    {
        return $this->bccs;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function getSubstitutions()
    {
        return $this->substitutions;
    }

    public function getCustomArgs()
    {
        return $this->custom_args;
    }

    public function getSendAt()
    {
        return $this->send_at;
    }
}

class Email implements \JsonSerializable
{
    private
        $name,
        $email;

    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'name' => $this->getName(),
                'email' => $this->getEmail()
            ]
        );
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }
}

/**
 * The final request body object
 */
class Mail implements \JsonSerializable
{
    const VERSION = '1.0.0';
    public
        $from,
        $personalization,
        $subject,
        $contents,
        $attachments,
        $template_id,
        $sections,
        $headers,
        $categories,
        $custom_args,
        $send_at,
        $batch_id,
        $asm,
        $ip_pool_name,
        $mail_settings,
        $tracking_settings,
        $reply_to;
    protected
        $namespace = 'SendGrid';

    public function __construct($from = null, $subject = null, $to = null, $content = null)
    {
        if (!empty($from) && !empty($subject) && !empty($to) && !empty($content)) {
            $this->setFrom($from);
            $personalization = new Personalization();
            $personalization->addTo($to);
            $this->addPersonalization($personalization);
            $this->setSubject($subject);
            $this->addContent($content);
        }

    }

    public function addPersonalization($personalization)
    {
        $this->personalization[] = $personalization;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function addContent($content)
    {
        $this->contents[] = $content;
    }

    public function addAttachment($attachment)
    {
        $this->attachments[] = $attachment;
    }

    public function setTemplateId($template_id)
    {
        $this->template_id = $template_id;
    }

    public function addSection($key, $value)
    {
        $this->sections[$key] = $value;
    }

    public function addHeader($key, $value)
    {
        $this->headers[$key] = $value;
    }

    public function addCategory($category)
    {
        $this->categories[] = $category;
    }

    public function addCustomArg($key, $value)
    {
        $this->custom_args[$key] = $value;
    }

    public function setSendAt($send_at)
    {
        $this->send_at = $send_at;
    }

    public function setBatchId($batch_id)
    {
        $this->batch_id = $batch_id;
    }

    public function setASM($asm)
    {
        $this->asm = $asm;
    }

    public function setIpPoolName($ip_pool_name)
    {
        $this->ip_pool_name = $ip_pool_name;
    }

    public function setMailSettings($mail_settings)
    {
        $this->mail_settings = $mail_settings;
    }

    public function setTrackingSettings($tracking_settings)
    {
        $this->tracking_settings = $tracking_settings;
    }

    public function setReplyTo($reply_to)
    {
        $this->reply_to = $reply_to;
    }

    public function jsonSerialize()
    {
        return array_filter(
            [
                'from' => $this->getFrom(),
                'personalizations' => $this->getPersonalizations(),
                'subject' => $this->getSubject(),
                'content' => $this->getContents(),
                'attachments' => $this->getAttachments(),
                'template_id' => $this->getTemplateId(),
                'sections' => $this->getSections(),
                'headers' => $this->getHeaders(),
                'categories' => $this->getCategories(),
                'custom_args' => $this->getCustomArgs(),
                'send_at' => $this->getSendAt(),
                'batch_id' => $this->getBatchId(),
                'asm' => $this->getASM(),
                'ip_pool_name' => $this->getIpPoolName(),
                'mail_settings' => $this->getMailSettings(),
                'tracking_settings' => $this->getTrackingSettings(),
                'reply_to' => $this->getReplyTo()
            ]
        );
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function setFrom($email)
    {
        $this->from = $email;
    }

    public function getPersonalizations()
    {
        return $this->personalization;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function getContents()
    {
        return $this->contents;
    }

    public function getAttachments()
    {
        return $this->attachments;
    }

    public function getTemplateId()
    {
        return $this->template_id;
    }

    public function getSections()
    {
        return $this->sections;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function getCategories()
    {
        return $this->categories;
    }

    public function getCustomArgs()
    {
        return $this->custom_args;
    }

    public function getSendAt()
    {
        return $this->send_at;
    }

    public function getBatchId()
    {
        return $this->batch_id;
    }

    public function getASM()
    {
        return $this->asm;
    }

    public function getIpPoolName()
    {
        return $this->ip_pool_name;
    }

    public function getMailSettings()
    {
        return $this->mail_settings;
    }

    public function getTrackingSettings()
    {
        return $this->tracking_settings;
    }

    public function getReplyTo()
    {
        return $this->reply_to;
    }
}
