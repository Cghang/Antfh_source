<?php

namespace AlibabaCloud\Vs\V20181212;

use AlibabaCloud\Client\Resolver\ApiResolver;

/**
 * @method DescribeDeviceChannels describeDeviceChannels(array $options = [])
 * @method SyncCatalogs syncCatalogs(array $options = [])
 * @method UnlockDevice unlockDevice(array $options = [])
 * @method DescribeVodStreamURL describeVodStreamURL(array $options = [])
 * @method BatchUnbindTemplates batchUnbindTemplates(array $options = [])
 * @method BatchBindTemplates batchBindTemplates(array $options = [])
 * @method BatchStopStreams batchStopStreams(array $options = [])
 * @method BatchStartStreams batchStartStreams(array $options = [])
 * @method DescribeStreamURL describeStreamURL(array $options = [])
 * @method BatchDeleteDevices batchDeleteDevices(array $options = [])
 * @method BatchStopDevices batchStopDevices(array $options = [])
 * @method BatchStartDevices batchStartDevices(array $options = [])
 * @method DescribeVsDomainCertificateInfo describeVsDomainCertificateInfo(array $options = [])
 * @method DescribeVsUserResourcePackage describeVsUserResourcePackage(array $options = [])
 * @method DescribeVsCertificateList describeVsCertificateList(array $options = [])
 * @method DescribeVsCertificateDetail describeVsCertificateDetail(array $options = [])
 * @method SetVsDomainCertificate setVsDomainCertificate(array $options = [])
 * @method DescribeVsDomainDetail describeVsDomainDetail(array $options = [])
 * @method DescribeVsDomainTrafficData describeVsDomainTrafficData(array $options = [])
 * @method DescribeVsDomainBpsData describeVsDomainBpsData(array $options = [])
 * @method DescribeVsDomainReqTrafficData describeVsDomainReqTrafficData(array $options = [])
 * @method DescribeVsDomainReqBpsData describeVsDomainReqBpsData(array $options = [])
 * @method DescribeVsDomainRecordData describeVsDomainRecordData(array $options = [])
 * @method DescribeVsDomainSnapshotData describeVsDomainSnapshotData(array $options = [])
 * @method StopDevice stopDevice(array $options = [])
 * @method StartDevice startDevice(array $options = [])
 * @method ModifyDevice modifyDevice(array $options = [])
 * @method CreateDevice createDevice(array $options = [])
 * @method DescribeDevice describeDevice(array $options = [])
 * @method DeleteDevice deleteDevice(array $options = [])
 * @method DescribeDevices describeDevices(array $options = [])
 * @method CreateTemplate createTemplate(array $options = [])
 * @method DeleteTemplate deleteTemplate(array $options = [])
 * @method BatchUnbindTemplate batchUnbindTemplate(array $options = [])
 * @method UnbindTemplate unbindTemplate(array $options = [])
 * @method BatchBindTemplate batchBindTemplate(array $options = [])
 * @method ModifyTemplate modifyTemplate(array $options = [])
 * @method DescribeTemplate describeTemplate(array $options = [])
 * @method DescribeTemplates describeTemplates(array $options = [])
 * @method BindTemplate bindTemplate(array $options = [])
 * @method ForbidVsStream forbidVsStream(array $options = [])
 * @method BatchForbidVsStream batchForbidVsStream(array $options = [])
 * @method DescribeStream describeStream(array $options = [])
 * @method BatchResumeVsStream batchResumeVsStream(array $options = [])
 * @method SetVsStreamsNotifyUrlConfig setVsStreamsNotifyUrlConfig(array $options = [])
 * @method ResumeVsStream resumeVsStream(array $options = [])
 * @method StartStream startStream(array $options = [])
 * @method DescribeVsStreamsNotifyUrlConfig describeVsStreamsNotifyUrlConfig(array $options = [])
 * @method DescribeVsStreamsPublishList describeVsStreamsPublishList(array $options = [])
 * @method DescribeVsUpPeakPublishStreamData describeVsUpPeakPublishStreamData(array $options = [])
 * @method DescribeStreams describeStreams(array $options = [])
 * @method DescribeVsStreamsOnlineList describeVsStreamsOnlineList(array $options = [])
 * @method DeleteVsStreamsNotifyUrlConfig deleteVsStreamsNotifyUrlConfig(array $options = [])
 * @method StopStream stopStream(array $options = [])
 * @method DescribeGroup describeGroup(array $options = [])
 * @method ModifyGroup modifyGroup(array $options = [])
 * @method CreateGroup createGroup(array $options = [])
 * @method DeleteGroup deleteGroup(array $options = [])
 * @method DescribeRecords describeRecords(array $options = [])
 * @method DescribeGroups describeGroups(array $options = [])
 * @method DescribeVsDomainConfigs describeVsDomainConfigs(array $options = [])
 * @method BatchSetVsDomainConfigs batchSetVsDomainConfigs(array $options = [])
 * @method BatchDeleteVsDomainConfigs batchDeleteVsDomainConfigs(array $options = [])
 */
class VsApiResolver extends ApiResolver
{
}

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'vs';

    /** @var string */
    public $version = '2018-12-12';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'vs';
}

/**
 * @method string getId()
 * @method $this withId($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeDeviceChannels extends Rpc
{
}

/**
 * @method string getId()
 * @method $this withId($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class SyncCatalogs extends Rpc
{
}

/**
 * @method string getId()
 * @method $this withId($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class UnlockDevice extends Rpc
{
}

/**
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getTxId()
 * @method $this withTxId($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getUrl()
 * @method $this withUrl($value)
 */
class DescribeVodStreamURL extends Rpc
{
}

/**
 * @method string getTemplateType()
 * @method $this withTemplateType($value)
 * @method string getInstanceType()
 * @method $this withInstanceType($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getTemplateId()
 * @method $this withTemplateId($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 */
class BatchUnbindTemplates extends Rpc
{
}

/**
 * @method string getReplace()
 * @method $this withReplace($value)
 * @method string getInstanceType()
 * @method $this withInstanceType($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getApplyAll()
 * @method $this withApplyAll($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getTemplateId()
 * @method $this withTemplateId($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 */
class BatchBindTemplates extends Rpc
{
}

/**
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getId()
 * @method $this withId($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class BatchStopStreams extends Rpc
{
}

/**
 * @method string getId()
 * @method $this withId($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class BatchStartStreams extends Rpc
{
}

/**
 * @method string getAuthKey()
 * @method $this withAuthKey($value)
 * @method string getAuth()
 * @method $this withAuth($value)
 * @method string getType()
 * @method $this withType($value)
 * @method string getId()
 * @method $this withId($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getOutProtocol()
 * @method $this withOutProtocol($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getExpire()
 * @method $this withExpire($value)
 * @method string getLocation()
 * @method $this withLocation($value)
 */
class DescribeStreamURL extends Rpc
{
}

/**
 * @method string getId()
 * @method $this withId($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class BatchDeleteDevices extends Rpc
{
}

/**
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getId()
 * @method $this withId($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class BatchStopDevices extends Rpc
{
}

/**
 * @method string getId()
 * @method $this withId($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class BatchStartDevices extends Rpc
{
}

/**
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getDomainName()
 * @method $this withDomainName($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeVsDomainCertificateInfo extends Rpc
{
}

/**
 * @method string getSecurityToken()
 * @method $this withSecurityToken($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 */
class DescribeVsUserResourcePackage extends Rpc
{
}

/**
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getDomainName()
 * @method $this withDomainName($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeVsCertificateList extends Rpc
{
}

/**
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getCertName()
 * @method $this withCertName($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeVsCertificateDetail extends Rpc
{
}

/**
 * @method string getSSLProtocol()
 * @method $this withSSLProtocol($value)
 * @method string getCertType()
 * @method $this withCertType($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getSSLPri()
 * @method $this withSSLPri($value)
 * @method string getForceSet()
 * @method $this withForceSet($value)
 * @method string getCertName()
 * @method $this withCertName($value)
 * @method string getDomainName()
 * @method $this withDomainName($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getSSLPub()
 * @method $this withSSLPub($value)
 * @method string getRegion()
 * @method $this withRegion($value)
 */
class SetVsDomainCertificate extends Rpc
{
}

/**
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getDomainName()
 * @method $this withDomainName($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeVsDomainDetail extends Rpc
{
}

/**
 * @method string getLocationNameEn()
 * @method $this withLocationNameEn($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getIspNameEn()
 * @method $this withIspNameEn($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getDomainName()
 * @method $this withDomainName($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getInterval()
 * @method $this withInterval($value)
 */
class DescribeVsDomainTrafficData extends Rpc
{
}

/**
 * @method string getLocationNameEn()
 * @method $this withLocationNameEn($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getIspNameEn()
 * @method $this withIspNameEn($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getDomainName()
 * @method $this withDomainName($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getInterval()
 * @method $this withInterval($value)
 */
class DescribeVsDomainBpsData extends Rpc
{
}

/**
 * @method string getLocationNameEn()
 * @method $this withLocationNameEn($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getIspNameEn()
 * @method $this withIspNameEn($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getDomainName()
 * @method $this withDomainName($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getInterval()
 * @method $this withInterval($value)
 */
class DescribeVsDomainReqTrafficData extends Rpc
{
}

/**
 * @method string getLocationNameEn()
 * @method $this withLocationNameEn($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getIspNameEn()
 * @method $this withIspNameEn($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getDomainName()
 * @method $this withDomainName($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getInterval()
 * @method $this withInterval($value)
 */
class DescribeVsDomainReqBpsData extends Rpc
{
}

/**
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getDomainName()
 * @method $this withDomainName($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeVsDomainRecordData extends Rpc
{
}

/**
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getDomainName()
 * @method $this withDomainName($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeVsDomainSnapshotData extends Rpc
{
}

/**
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getId()
 * @method $this withId($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class StopDevice extends Rpc
{
}

/**
 * @method string getId()
 * @method $this withId($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class StartDevice extends Rpc
{
}

/**
 * @method string getGbId()
 * @method $this withGbId($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getType()
 * @method $this withType($value)
 * @method string getAutoStart()
 * @method $this withAutoStart($value)
 * @method string getParentId()
 * @method $this withParentId($value)
 * @method string getPassword()
 * @method $this withPassword($value)
 * @method string getVendor()
 * @method $this withVendor($value)
 * @method string getId()
 * @method $this withId($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getGroupId()
 * @method $this withGroupId($value)
 * @method string getIp()
 * @method $this withIp($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getUrl()
 * @method $this withUrl($value)
 * @method string getPort()
 * @method $this withPort($value)
 * @method string getName()
 * @method $this withName($value)
 * @method string getUsername()
 * @method $this withUsername($value)
 */
class ModifyDevice extends Rpc
{
}

/**
 * @method string getGbId()
 * @method $this withGbId($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getType()
 * @method $this withType($value)
 * @method string getAutoStart()
 * @method $this withAutoStart($value)
 * @method string getParentId()
 * @method $this withParentId($value)
 * @method string getPassword()
 * @method $this withPassword($value)
 * @method string getVendor()
 * @method $this withVendor($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getGroupId()
 * @method $this withGroupId($value)
 * @method string getIp()
 * @method $this withIp($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getUrl()
 * @method $this withUrl($value)
 * @method string getPort()
 * @method $this withPort($value)
 * @method string getName()
 * @method $this withName($value)
 * @method string getUsername()
 * @method $this withUsername($value)
 */
class CreateDevice extends Rpc
{
}

/**
 * @method string getIncludeStats()
 * @method $this withIncludeStats($value)
 * @method string getId()
 * @method $this withId($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeDevice extends Rpc
{
}

/**
 * @method string getId()
 * @method $this withId($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DeleteDevice extends Rpc
{
}

/**
 * @method string getSortDirection()
 * @method $this withSortDirection($value)
 * @method string getType()
 * @method $this withType($value)
 * @method string getPageNum()
 * @method $this withPageNum($value)
 * @method string getParentId()
 * @method $this withParentId($value)
 * @method string getIncludeStats()
 * @method $this withIncludeStats($value)
 * @method string getVendor()
 * @method $this withVendor($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getId()
 * @method $this withId($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getGroupId()
 * @method $this withGroupId($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getName()
 * @method $this withName($value)
 * @method string getSortBy()
 * @method $this withSortBy($value)
 * @method string getStatus()
 * @method $this withStatus($value)
 */
class DescribeDevices extends Rpc
{
}

/**
 * @method string getHlsTs()
 * @method $this withHlsTs($value)
 * @method string getOssEndpoint()
 * @method $this withOssEndpoint($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getOssFilePrefix()
 * @method $this withOssFilePrefix($value)
 * @method string getJpgOverwrite()
 * @method $this withJpgOverwrite($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getType()
 * @method $this withType($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getHlsM3u8()
 * @method $this withHlsM3u8($value)
 * @method string getOssBucket()
 * @method $this withOssBucket($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getJpgSequence()
 * @method $this withJpgSequence($value)
 * @method string getMp4()
 * @method $this withMp4($value)
 * @method string getFlv()
 * @method $this withFlv($value)
 * @method string getName()
 * @method $this withName($value)
 * @method string getCallback()
 * @method $this withCallback($value)
 * @method string getInterval()
 * @method $this withInterval($value)
 * @method string getFileFormat()
 * @method $this withFileFormat($value)
 * @method string getRegion()
 * @method $this withRegion($value)
 */
class CreateTemplate extends Rpc
{
}

/**
 * @method string getId()
 * @method $this withId($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DeleteTemplate extends Rpc
{
}

/**
 * @method string getTemplateType()
 * @method $this withTemplateType($value)
 * @method string getInstanceType()
 * @method $this withInstanceType($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getTemplateId()
 * @method $this withTemplateId($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 */
class BatchUnbindTemplate extends Rpc
{
}

/**
 * @method string getTemplateType()
 * @method $this withTemplateType($value)
 * @method string getInstanceType()
 * @method $this withInstanceType($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getTemplateId()
 * @method $this withTemplateId($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 */
class UnbindTemplate extends Rpc
{
}

/**
 * @method string getReplace()
 * @method $this withReplace($value)
 * @method string getInstanceType()
 * @method $this withInstanceType($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getApplyAll()
 * @method $this withApplyAll($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getTemplateId()
 * @method $this withTemplateId($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 */
class BatchBindTemplate extends Rpc
{
}

/**
 * @method string getHlsTs()
 * @method $this withHlsTs($value)
 * @method string getOssEndpoint()
 * @method $this withOssEndpoint($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getOssFilePrefix()
 * @method $this withOssFilePrefix($value)
 * @method string getJpgOverwrite()
 * @method $this withJpgOverwrite($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getType()
 * @method $this withType($value)
 * @method string getId()
 * @method $this withId($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getHlsM3u8()
 * @method $this withHlsM3u8($value)
 * @method string getOssBucket()
 * @method $this withOssBucket($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getJpgSequence()
 * @method $this withJpgSequence($value)
 * @method string getMp4()
 * @method $this withMp4($value)
 * @method string getFlv()
 * @method $this withFlv($value)
 * @method string getName()
 * @method $this withName($value)
 * @method string getCallback()
 * @method $this withCallback($value)
 * @method string getInterval()
 * @method $this withInterval($value)
 * @method string getFileFormat()
 * @method $this withFileFormat($value)
 * @method string getRegion()
 * @method $this withRegion($value)
 */
class ModifyTemplate extends Rpc
{
}

/**
 * @method string getId()
 * @method $this withId($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeTemplate extends Rpc
{
}

/**
 * @method string getSortDirection()
 * @method $this withSortDirection($value)
 * @method string getType()
 * @method $this withType($value)
 * @method string getPageNum()
 * @method $this withPageNum($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getId()
 * @method $this withId($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getSortBy()
 * @method $this withSortBy($value)
 */
class DescribeTemplates extends Rpc
{
}

/**
 * @method string getReplace()
 * @method $this withReplace($value)
 * @method string getInstanceType()
 * @method $this withInstanceType($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getApplyAll()
 * @method $this withApplyAll($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getTemplateId()
 * @method $this withTemplateId($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 */
class BindTemplate extends Rpc
{
}

/**
 * @method string getAppName()
 * @method $this withAppName($value)
 * @method string getStreamName()
 * @method $this withStreamName($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getControlStreamAction()
 * @method $this withControlStreamAction($value)
 * @method string getResumeTime()
 * @method $this withResumeTime($value)
 * @method string getLiveStreamType()
 * @method $this withLiveStreamType($value)
 * @method string getDomainName()
 * @method $this withDomainName($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getOneshot()
 * @method $this withOneshot($value)
 */
class ForbidVsStream extends Rpc
{
}

/**
 * @method string getChannel()
 * @method $this withChannel($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getControlStreamAction()
 * @method $this withControlStreamAction($value)
 * @method string getResumeTime()
 * @method $this withResumeTime($value)
 * @method string getLiveStreamType()
 * @method $this withLiveStreamType($value)
 * @method string getDomainName()
 * @method $this withDomainName($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getOneshot()
 * @method $this withOneshot($value)
 */
class BatchForbidVsStream extends Rpc
{
}

/**
 * @method string getId()
 * @method $this withId($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeStream extends Rpc
{
}

/**
 * @method string getChannel()
 * @method $this withChannel($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getControlStreamAction()
 * @method $this withControlStreamAction($value)
 * @method string getLiveStreamType()
 * @method $this withLiveStreamType($value)
 * @method string getDomainName()
 * @method $this withDomainName($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class BatchResumeVsStream extends Rpc
{
}

/**
 * @method string getAuthKey()
 * @method $this withAuthKey($value)
 * @method string getAuthType()
 * @method $this withAuthType($value)
 * @method string getNotifyUrl()
 * @method $this withNotifyUrl($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getDomainName()
 * @method $this withDomainName($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class SetVsStreamsNotifyUrlConfig extends Rpc
{
}

/**
 * @method string getAppName()
 * @method $this withAppName($value)
 * @method string getStreamName()
 * @method $this withStreamName($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getControlStreamAction()
 * @method $this withControlStreamAction($value)
 * @method string getLiveStreamType()
 * @method $this withLiveStreamType($value)
 * @method string getDomainName()
 * @method $this withDomainName($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class ResumeVsStream extends Rpc
{
}

/**
 * @method string getId()
 * @method $this withId($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class StartStream extends Rpc
{
}

/**
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getDomainName()
 * @method $this withDomainName($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeVsStreamsNotifyUrlConfig extends Rpc
{
}

/**
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getAppName()
 * @method $this withAppName($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getStreamName()
 * @method $this withStreamName($value)
 * @method string getQueryType()
 * @method $this withQueryType($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getStreamType()
 * @method $this withStreamType($value)
 * @method string getDomainName()
 * @method $this withDomainName($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getOrderBy()
 * @method $this withOrderBy($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeVsStreamsPublishList extends Rpc
{
}

/**
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getDomainName()
 * @method $this withDomainName($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDomainSwitch()
 * @method $this withDomainSwitch($value)
 */
class DescribeVsUpPeakPublishStreamData extends Rpc
{
}

/**
 * @method string getSortDirection()
 * @method $this withSortDirection($value)
 * @method string getPageNum()
 * @method $this withPageNum($value)
 * @method string getParentId()
 * @method $this withParentId($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getId()
 * @method $this withId($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getApp()
 * @method $this withApp($value)
 * @method string getGroupId()
 * @method $this withGroupId($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDeviceId()
 * @method $this withDeviceId($value)
 * @method string getDomain()
 * @method $this withDomain($value)
 * @method string getName()
 * @method $this withName($value)
 * @method string getSortBy()
 * @method $this withSortBy($value)
 */
class DescribeStreams extends Rpc
{
}

/**
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getPageNum()
 * @method $this withPageNum($value)
 * @method string getAppName()
 * @method $this withAppName($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getStreamName()
 * @method $this withStreamName($value)
 * @method string getQueryType()
 * @method $this withQueryType($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getStreamType()
 * @method $this withStreamType($value)
 * @method string getDomainName()
 * @method $this withDomainName($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getOrderBy()
 * @method $this withOrderBy($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeVsStreamsOnlineList extends Rpc
{
}

/**
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getDomainName()
 * @method $this withDomainName($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DeleteVsStreamsNotifyUrlConfig extends Rpc
{
}

/**
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getId()
 * @method $this withId($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class StopStream extends Rpc
{
}

/**
 * @method string getIncludeStats()
 * @method $this withIncludeStats($value)
 * @method string getId()
 * @method $this withId($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeGroup extends Rpc
{
}

/**
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getEnabled()
 * @method $this withEnabled($value)
 * @method string getPushDomain()
 * @method $this withPushDomain($value)
 * @method string getId()
 * @method $this withId($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getPlayDomain()
 * @method $this withPlayDomain($value)
 * @method string getOutProtocol()
 * @method $this withOutProtocol($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getInProtocol()
 * @method $this withInProtocol($value)
 * @method string getName()
 * @method $this withName($value)
 * @method string getRegion()
 * @method $this withRegion($value)
 */
class ModifyGroup extends Rpc
{
}

/**
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getPushDomain()
 * @method $this withPushDomain($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getApp()
 * @method $this withApp($value)
 * @method string getPlayDomain()
 * @method $this withPlayDomain($value)
 * @method string getOutProtocol()
 * @method $this withOutProtocol($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getInProtocol()
 * @method $this withInProtocol($value)
 * @method string getName()
 * @method $this withName($value)
 * @method string getRegion()
 * @method $this withRegion($value)
 */
class CreateGroup extends Rpc
{
}

/**
 * @method string getId()
 * @method $this withId($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DeleteGroup extends Rpc
{
}

/**
 * @method string getSortDirection()
 * @method $this withSortDirection($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getType()
 * @method $this withType($value)
 * @method string getPageNum()
 * @method $this withPageNum($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getStreamId()
 * @method $this withStreamId($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getSortBy()
 * @method $this withSortBy($value)
 */
class DescribeRecords extends Rpc
{
}

/**
 * @method string getSortDirection()
 * @method $this withSortDirection($value)
 * @method string getPageNum()
 * @method $this withPageNum($value)
 * @method string getIncludeStats()
 * @method $this withIncludeStats($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getId()
 * @method $this withId($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getInProtocol()
 * @method $this withInProtocol($value)
 * @method string getName()
 * @method $this withName($value)
 * @method string getSortBy()
 * @method $this withSortBy($value)
 * @method string getRegion()
 * @method $this withRegion($value)
 * @method string getStatus()
 * @method $this withStatus($value)
 */
class DescribeGroups extends Rpc
{
}

/**
 * @method string getFunctionNames()
 * @method $this withFunctionNames($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getDomainName()
 * @method $this withDomainName($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeVsDomainConfigs extends Rpc
{
}

/**
 * @method string getFunctions()
 * @method $this withFunctions($value)
 * @method string getDomainNames()
 * @method $this withDomainNames($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class BatchSetVsDomainConfigs extends Rpc
{
}

/**
 * @method string getFunctionNames()
 * @method $this withFunctionNames($value)
 * @method string getDomainNames()
 * @method $this withDomainNames($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class BatchDeleteVsDomainConfigs extends Rpc
{
}
