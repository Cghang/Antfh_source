# CHANGELOG

## 1.7.66 - 2019-8-12
- Support Defect Face API.


## 1.7.65 - 2019-8-9
- Add a lot of new API.


## 1.7.64 - 2019-8-8
- Add CreateStorageSet api to support storageSet.
- Add DeleteStorageSet api to support storageSet.
- Add ModifyStorageSetAttribute api to support storageSet.
- Add DescribeStorageSets api to support storageSet.
- Add DescribeStorageSetDetails api to support storageSet.
- Add parameter StorageSetId,StorageSetPartitionNumber to api CreateDisk,RunInstances,CreateInstance support storageSet.
- Add StorageSetId,StorageSetPartitionNumber with response of api DescribeDisks.
- Add DescribeNetworkInterfaces to support filter by PrivateIpAddress.


## 1.7.63 - 2019-8-8
- Group, Plugin support tag authentication.


## 1.7.62 - 2019-8-7
- Generated 2018-03-13 for `retailcloud`.


## 1.7.61 - 2019-8-6
- Supported GetMediaMeta for IMM.


## 1.7.60 - 2019-8-6
- Supported GetMediaMeta for IMM.


## 1.7.59 - 2019-8-6
- Supported GetMediaMeta for IMM.


## 1.7.58 - 2019-8-6
- Supported GetMediaMeta for IMM.


## 1.7.57 - 2019-8-6
- Supported GetMediaMeta for IMM.


## 1.7.56 - 2019-8-5
- GetOrderDetail add originalConfig param.


## 1.7.55 - 2019-8-5
- GetOrderDetail add originalConfig param.


## 1.7.54 - 2019-8-5
- Modify DBS API DescribeFullBackupList.


## 1.7.53 - 2019-8-2
- SubscribeBillToOSSRequest add multAccountRelSubscribe, bucketOwnerId.
- UnsubscribeBillToOSSRequest add multAccountRelSubscribe.


## 1.7.52 - 2019-7-31
- Endpoint auto route.


## 1.7.51 - 2019-7-30
- Suport ImportCredentials api.


## 1.7.50 - 2019-7-30
- Suport ImportCredentials api.


## 1.7.49 - 2019-7-29
- Supported group API.
- Supported device APIs.
- Supported stream APIs.
- Supported template APIs.
- Supported record APIs.
- Supported domain APIs.


## 1.7.48 - 2019-7-26
- Generated 2019-05-24 for `cusanalytic_sc_online`.


## 1.7.47 - 2019-7-26
- Generated 2019-05-24 for `cusanalytic_sc_online`.


## 1.7.46 - 2019-7-25
- Api createKey add optional parameter `ProtectionLevel`.
- Api describeKey add a field `ProtectionLevel` in the response.
- Add Api `DescribeService`.


## 1.7.45 - 2019-7-25
- App-related actions support tag authentication.


## 1.7.44 - 2019-7-23
- Supported CreationOption of CreateDBCluster with `CloneFromPolarDB `,`CloneFromRDS`,`MigrationFromRDS`.


## 1.7.43 - 2019-7-19
- QueryMonthlyBillResponse add roundDownDiscount.
- QueryBillResponse add roundDownDiscount.
- QueryInstanceBillResponse add item.


## 1.7.42 - 2019-7-18
- Generated 2016-06-07 for `cr`.


## 1.7.41 - 2019-7-18
- Add a new field named Input to SubmitAIJob api request to set the input file of AI job.
- Change the field MediaId of SubmitAIJob api to non-mandatory.


## 1.7.40 - 2019-7-17
- Add a lot of new API.


## 1.7.39 - 2019-7-14
- Modify DBS API DescribeBackupPlanList.


## 1.7.38 - 2019-7-12
- Public api AddLivePullStreamInfoConfig.


## 1.7.37 - 2019-7-11
- Modify CreateBackupPlan.
- Modify ConfigureBackupPlan.
- Modify DescribeFullBackupList.
- Modify DescribeRestoreTaskList.
- Add ModifyBackupSourceEndpoint.
- Add ModifyBackupStrategy.
- Add ModifyBackupPlanName.


## 1.7.36 - 2019-7-5
- Supported library managment for simillarity scene.
- Remove the local file uploader code which can be downloaded from yundun content security document.


## 1.7.35 - 2019-7-5
- Add TaskCancelStatus for QueryTaskList api.


## 1.7.34 - 2019-7-4
- Supported API DescribeRecordStatisticsy for Query Volume.
- Supported API DescribeDomainStatistics for Query Volume.


## 1.7.33 - 2019-7-4
- Supported batch querying for device detail.


## 1.7.32 - 2019-7-3
- Supported API DescribeRecordStatisticsSummary for Query Volume.
- Supported API DescribeDomainStatisticsSummary for Query Volume.
- Supported API DescribeRecordStatisticsHistory for Query Volume.
- Supported API DescribeDomainDnsStatistics for Query Volume.


## 1.7.31 - 2019-7-2
- FnF public version.


## 1.7.30 - 2019-7-1
- Support cloud_essd disk category for API CreateDisk, CreateInstance and RunInstances, and support configurating PerformanceLevel when choose cloud_essd.
- Add ModifyDiskSpec API to support cloud_essd PerformanceLevel modification.
- Add AutoProvisioningGroup interfaces, provide AutoProvisioningGroup function.
- Add RetentionDays to snapshot creating.


## 1.7.29 - 2019-6-27
- Added setting of crop_mode parameter.


## 1.7.28 - 2019-6-24
- Add some new apis to manage VoD domain, such as AddVodDomain, UpdateVodDomain, DeleteVodDomain, BatchStartVodDomain, BatchStopVodDomain, DescribeVodUserDomains, DescribeVodDomainDetail.
- Add some new apis to manage VoD domain config, such as BatchSetVodDomainConfigs, DescribeVodDomainConfigs, DeleteVodSpecificConfig, SetVodDomainCertificate, DescribeVodCertificateList, DescribeVodDomainCertificateInfo.
- Add a new field named AppId to some apis supporting the VoD App feature, such as AddWorkFlow, GetWorkFlow, ListWorkFlow, AddVodTemplate, GetVodTemplate, ListVodTemplate, AddTranscodeTemplateGroup, GetTranscodeTemplateGroup, ListTranscodeTemplateGroup, AddWatermark, GetWatermark, ListWatermark, UploadMediaByURL.
- Add a new field named UserData to SubmitTranscodeJobs api request to support user-defined extension fields, which can be used for transparent return when callbacks.


## 1.7.27 - 2019-6-24
- Add some new apis to manage VoD domain, such as AddVodDomain, UpdateVodDomain, DeleteVodDomain, BatchStartVodDomain, BatchStopVodDomain, DescribeVodUserDomains, DescribeVodDomainDetail.
- Add some new apis to manage VoD domain config, such as BatchSetVodDomainConfigs, DescribeVodDomainConfigs, DeleteVodSpecificConfig, SetVodDomainCertificate, DescribeVodCertificateList, DescribeVodDomainCertificateInfo.
- Add a new field named AppId to some apis supporting the VoD App feature, such as AddWorkFlow, GetWorkFlow, ListWorkFlow, AddVodTemplate, GetVodTemplate, ListVodTemplate, AddTranscodeTemplateGroup, GetTranscodeTemplateGroup, ListTranscodeTemplateGroup, AddWatermark, GetWatermark, ListWatermark, UploadMediaByURL.
- Add a new field named UserData to SubmitTranscodeJobs api request to support user-defined extension fields, which can be used for transparent return when callbacks.


## 1.7.26 - 2019-6-19
- Removed 2018-12-01 for `cr`.


## 1.7.25 - 2019-6-19
- Generated 2018-12-01 for `cr`.


## 1.7.24 - 2019-6-19
1, Add DefaultPolicyVersion as return field to GetPolicy interface, Facilitating to get policy document from this interface.
2, Add RotateStrategy as input field to CreatePolicyVersion interface for rotating policy version when reaching policy version limit.


## 1.7.23 - 2019-6-18
- Supported the related recommend.
- Supported exposure time controll and exposure filter by scene.


## 1.7.22 - 2019-6-17
- Companyreg release.


## 1.7.21 - 2019-6-13
- Fixed DescribeAvailableResource OpenApi AvailableZones value problem.


## 1.7.20 - 2019-6-13
- Generated 2015-01-01 for `R-kvstore`.


## 1.7.19 - 2019-6-13
- Added Network Assistant openapi SDK.


## 1.7.18 - 2019-6-13
- Added DescribeAvailableResource OpenApi.
- Upgrade version to 2.3.8


## 1.7.17 - 2019-6-12
- Added RenewBackupPlan DBS interface.


## 1.7.16 - 2019-6-12
- Fixed bug.


## 1.7.15 - 2019-6-12
- Generated 2018-12-01 for `cr`.


## 1.7.14 - 2019-6-12
- Added InvokeDataAPIService interface, support invoke service of data api to get sql query result.
- Added GetDataAPIServiceDetail interface, support get data api's detail information.
- Added CreateDataAPIService interface, support create data api with sql statement.


## 1.7.13 - 2019-6-12
- Removed `2015-05-06`,`2018-12-01` for `Cr`.


## 1.7.12 - 2019-6-12
- Generated 2019-03-06 for `Dbs`.


## 1.7.11 - 2019-6-11
- Generated 2015-05-06, 2016-06-07, 2018-12-01 for `cr`.


## 1.7.10 - 2019-6-10
- Generated 2015-05-06, 2016-06-07, 2018-12-01 for `cr`.


## 1.7.9 - 2019-6-3
- Generated 2018-01-12 for `afs`.


## 1.7.8 - 2019-6-3
- Generated 2018-05-24 for `welfare-inner`.


## 1.7.7 - 2019-6-2
- Generated 2015-05-06, 2016-06-07, 2018-12-01 for `cr`.


## 1.7.6 - 2019-5-31
- Generated 2016-11-11, 2015-06-30 for `BatchCompute`.


## 1.7.5 - 2019-5-30
- Generated 2013-01-11, 2016-11-11 for `BatchCompute`.


## 1.7.4 - 2019-5-30
- Generated 2019-05-21 for `saf`.


## 1.7.3 - 2019-5-30
- Generated 2015-12-15, 2018-04-18 for `CS`.


## 1.7.2 - 2019-5-30
- Generated 2014-02-14, 2015-05-01, 2018-03-02 for `Ram`.


## 1.7.1 - 2019-5-30
- Generated 2015-05-06, 2016-06-07, 2018-12-01 for `cr`.


## 1.7.0 - 2019-5-29
- Supported `replace`. 


## 1.6.8 - 2019-5-29
- Update Smartag.


## 1.6.7 - 2019-5-29
- Update product.


## 1.6.6 - 2019-5-29
- Generated 2015-05-06, 2016-06-07, 2018-12-01 for `cr`.


## 1.6.5 - 2019-5-29
- Generated 2015-05-06 for `cr`.


## 1.6.4 - 2019-05-27
- Improved Docs.
- Updated APIs.


## 1.6.3 - 2019-05-20
- Updated APIs.


## 1.6.2 - 2019-05-16
- Updated APIs.


## 1.6.1 - 2019-05-09
- Regenerate products.
- Generate `composer.json` for each product.


## 1.6.0 - 2019-05-07
- Changed `Resolver` file name.


## 1.5.1 - 2019-04-19
- Supported `Sas`, `Ivision`.
- Added tests for `Sas`, `Ivision`.


## 1.5.0 - 2019-04-18
- Improved parameters methods.
- Optimized the logic for body encode.


## 1.4.0 - 2019-04-11
- Added `2019-03-25` for `ImageSearch`.


## 1.3.5 - 2019-04-09
- Support `Kms`.


## 1.3.4 - 2019-04-09
- Fixed `MNS`.


## 1.3.3 - 2019-04-08
- Added Apis for `Dbs`.


## 1.3.2 - 2019-04-08
- Support `Dypnsapi`.


## 1.3.1 - 2019-04-02
- Remove `finmall`.


## 1.3.0 - 2019-04-01
- Updated `composer.json`.


## 1.2.10 - 2019-03-27
- Improve `Resolver`.


## 1.2.9 - 2019-03-27
- Support `Dbs`.
- Support `AliProbe`.
- Fixed `BatchReceiveMessage`.


## 1.2.8 - 2019-03-25
- Updated README.md.
- Updated Apis.


## 1.2.7 - 2019-03-24
- Append `SDK` for User-Agent.


## 1.2.6 - 2019-03-24
- Update APIs.


## 1.2.5 - 2019-03-23
- Remove SVG.


## 1.2.4 - 2019-03-19
- Support `alikafka`.
- Support `bss`.
- Support `cds`.
- Support `cf`.
- Support `Commondriver`.
- Support `dataworks-public`.
- Support `drcloud`.
- Support `Edas`.
- Support `Foas`.
- Support `HPC`.
- Support `ITaaS`.
- Support `jarvis-public`.
- Support `LinkWAN`.
- Support `Lubanruler`.
- Support `Oms`.
- Support `PTS`.
- Support `Qualitycheck`.
- Support `waf-openapi`.


## 1.2.3 - 2019-03-19
- Support `cloudwf`.
- Update APIs for `Aegis`.
- Update APIs for `cdn`.
- Update APIs for `dcdn`.
- Update APIs for `imm`.
- Update APIs for `live`.
- Update APIs for `NAS`.


## 1.2.2 - 2019-03-19
- Update docs.


## 1.2.1 - 2019-03-17
- Add `Supported.md`.
- Support `ProductCatalog`.
- Support `polardb`.
- Support `cloudmarketing`.
- Support `Aas`.
- Support `Ft`.
- Support `gpdb`.
- Support `OssAdmin`.
- Support `PetaData`.


## 1.2.0 - 2019-03-16
- Redesign the request class to reduce the code size.
- Support `Yundun`.
- Support `Actiontrail`.
- Support `industry-brain`.
- Support `welfare-inner`.
- Support `xspace`.
- Support `ROS`.
- Support `openanalytics`.
- Support `Cbn`.
- Support `cr`.
- Support `MoPen`.
- Support `Snsuapi`.
- Support `finmall`.
- Support `Emr`.

## 1.1.2 - 2019-03-15
- Add `Iot` Tests.
- Add `Aegis` Apis.


## 1.1.1 - 2019-03-14
- Add `DescribeWhiteListStrategyList` for `Aegis`.
- Add `DescribeAvailableCrossRegion` for `Rds`.
- Add `DescribeAvailableRecoveryTime` for `Rds`.
- Add `DescribeCrossRegionBackupDBInstance` for `Rds`.
- Update Apis for `Aegis`.
- Update Apis for `BssOpenApi`.
- Update Apis for `Green`.


## 1.1.0 - 2019-03-14
- IDE auto-prompt for unlabeling discarded methods.
- Reduce size.
- Added support for 127 Api.
- Functional testing increased from 28 to 35.


## 1.0.10 - 2019-03-13
- Update Docs.


## 1.0.9 - 2019-03-07
- Optimize api analysis.


## 1.0.8 - 2019-02-22
- 238 interfaces added to support 29 products.


## 1.0.7 - 2019-02-21
- Add APIs for `VOD`.


## 1.0.6 - 2019-02-12
- Support Image Search.


## 1.0.5 - 2019-01-23
- `AlibabaCloud\Dybaseapi\MNS` - Support MNS with Feature test.
- Update readme.
- Update bootstrap for test.


## 1.0.4 - 2019-01-15
- Improve Test.
- Improve Resolver.


## 1.0.3 - 2019-01-11
- `AlibabaCloud\CloudAPI` - Support CloudAPI.


## 1.0.2 - 2019-01-11
- Support test on the Windows.


## 1.0.1 - 2019-01-09
- `AlibabaCloud\NlsFiletrans` - Support NLS Filetrans.
- `AlibabaCloud\NlsCloudMeta` - Support NLS Cloud Meta.

## 1.0.0 - 2019-01-07
- Initial release of the Alibaba Cloud SDK for PHP Version 1.0.0 on Packagist See <https://github.com/aliyun/openapi-sdk-php> for more information.
