<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/api/backend.proto

namespace GPBMetadata\Google\Api;

class Backend
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
          return;
        }
        $pool->internalAddGeneratedFile(
            '
†
google/api/backend.proto
google.api"1
Backend&
rules (2.google.api.BackendRule"˛
BackendRule
selector (	
address (	
deadline (
min_deadline (B
operation_deadline (A
path_translation (2\'.google.api.BackendRule.PathTranslation
jwt_audience (	H 
disable_auth (H 
protocol	 (	^
overrides_by_request_protocol
 (27.google.api.BackendRule.OverridesByRequestProtocolEntryZ
OverridesByRequestProtocolEntry
key (	&
value (2.google.api.BackendRule:8"e
PathTranslation 
PATH_TRANSLATION_UNSPECIFIED 
CONSTANT_ADDRESS
APPEND_PATH_TO_ADDRESSB
authenticationBn
com.google.apiBBackendProtoPZEgoogle.golang.org/genproto/googleapis/api/serviceconfig;serviceconfig˘GAPIbproto3'
        , true);

        static::$is_initialized = true;
    }
}

