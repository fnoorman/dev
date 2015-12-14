<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;
//use frontend\assets\DropzoneUnifyAsset;
//
//DropzoneUnifyAsset::register($this);

/* @var $this yii\web\View */
/* @var $model common\models\Video */

$this->title = Yii::t('app', 'Create Video');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Videos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(Url::base(true).'/upload.js',['depends'=>['yii\web\JqueryAsset'],'position'=>View::POS_END]);


?>

<style>
    #drop_zone {
        border: 2px dashed #bbb;
        /*-moz-border-radius: 5px;*/
        /*-webkit-border-radius: 5px;*/
        border-radius: 5px;
        padding: 25px;
        text-align: center;
        font: 20pt bold 'Helvetica';
        color: #bbb;
    }
</style>

<style type="text/css">
    /*
 *  Usage:
 *
 *    <div class="sk-circle">
 *      <div class="sk-circle1 sk-child"></div>
 *      <div class="sk-circle2 sk-child"></div>
 *      <div class="sk-circle3 sk-child"></div>
 *      <div class="sk-circle4 sk-child"></div>
 *      <div class="sk-circle5 sk-child"></div>
 *      <div class="sk-circle6 sk-child"></div>
 *      <div class="sk-circle7 sk-child"></div>
 *      <div class="sk-circle8 sk-child"></div>
 *      <div class="sk-circle9 sk-child"></div>
 *      <div class="sk-circle10 sk-child"></div>
 *      <div class="sk-circle11 sk-child"></div>
 *      <div class="sk-circle12 sk-child"></div>
 *    </div>
 *
 */
    .sk-circle {
        margin: 40px auto;
        width: 40px;
        height: 40px;
        position: relative; }
    .sk-circle .sk-child {
        width: 100%;
        height: 100%;
        position: absolute;
        left: 0;
        top: 0; }
    .sk-circle .sk-child:before {
        content: '';
        display: block;
        margin: 0 auto;
        width: 15%;
        height: 15%;
        background-color: #333;
        border-radius: 100%;
        -webkit-animation: sk-circleBounceDelay 1.2s infinite ease-in-out both;
        animation: sk-circleBounceDelay 1.2s infinite ease-in-out both; }
    .sk-circle .sk-circle2 {
        -webkit-transform: rotate(30deg);
        -ms-transform: rotate(30deg);
        transform: rotate(30deg); }
    .sk-circle .sk-circle3 {
        -webkit-transform: rotate(60deg);
        -ms-transform: rotate(60deg);
        transform: rotate(60deg); }
    .sk-circle .sk-circle4 {
        -webkit-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
        transform: rotate(90deg); }
    .sk-circle .sk-circle5 {
        -webkit-transform: rotate(120deg);
        -ms-transform: rotate(120deg);
        transform: rotate(120deg); }
    .sk-circle .sk-circle6 {
        -webkit-transform: rotate(150deg);
        -ms-transform: rotate(150deg);
        transform: rotate(150deg); }
    .sk-circle .sk-circle7 {
        -webkit-transform: rotate(180deg);
        -ms-transform: rotate(180deg);
        transform: rotate(180deg); }
    .sk-circle .sk-circle8 {
        -webkit-transform: rotate(210deg);
        -ms-transform: rotate(210deg);
        transform: rotate(210deg); }
    .sk-circle .sk-circle9 {
        -webkit-transform: rotate(240deg);
        -ms-transform: rotate(240deg);
        transform: rotate(240deg); }
    .sk-circle .sk-circle10 {
        -webkit-transform: rotate(270deg);
        -ms-transform: rotate(270deg);
        transform: rotate(270deg); }
    .sk-circle .sk-circle11 {
        -webkit-transform: rotate(300deg);
        -ms-transform: rotate(300deg);
        transform: rotate(300deg); }
    .sk-circle .sk-circle12 {
        -webkit-transform: rotate(330deg);
        -ms-transform: rotate(330deg);
        transform: rotate(330deg); }
    .sk-circle .sk-circle2:before {
        -webkit-animation-delay: -1.1s;
        animation-delay: -1.1s; }
    .sk-circle .sk-circle3:before {
        -webkit-animation-delay: -1s;
        animation-delay: -1s; }
    .sk-circle .sk-circle4:before {
        -webkit-animation-delay: -0.9s;
        animation-delay: -0.9s; }
    .sk-circle .sk-circle5:before {
        -webkit-animation-delay: -0.8s;
        animation-delay: -0.8s; }
    .sk-circle .sk-circle6:before {
        -webkit-animation-delay: -0.7s;
        animation-delay: -0.7s; }
    .sk-circle .sk-circle7:before {
        -webkit-animation-delay: -0.6s;
        animation-delay: -0.6s; }
    .sk-circle .sk-circle8:before {
        -webkit-animation-delay: -0.5s;
        animation-delay: -0.5s; }
    .sk-circle .sk-circle9:before {
        -webkit-animation-delay: -0.4s;
        animation-delay: -0.4s; }
    .sk-circle .sk-circle10:before {
        -webkit-animation-delay: -0.3s;
        animation-delay: -0.3s; }
    .sk-circle .sk-circle11:before {
        -webkit-animation-delay: -0.2s;
        animation-delay: -0.2s; }
    .sk-circle .sk-circle12:before {
        -webkit-animation-delay: -0.1s;
        animation-delay: -0.1s; }

    @-webkit-keyframes sk-circleBounceDelay {
        0%, 80%, 100% {
            -webkit-transform: scale(0);
            transform: scale(0); }
        40% {
            -webkit-transform: scale(1);
            transform: scale(1); } }

    @keyframes sk-circleBounceDelay {
        0%, 80%, 100% {
            -webkit-transform: scale(0);
            transform: scale(0); }
        40% {
            -webkit-transform: scale(1);
            transform: scale(1); } }

</style>
<div class="col-md-9">
    <div class="profile-body">
        <div class="headline">
            <h2>Step 2 : Video Campaign</h2>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tag-box tag-box-v2 box-shadow shadow-effect-1">
                    <p><span class="badge rounded-x badge-green">1</span>  &nbsp Please drop your video file to upload</p>
                    <p><span class="badge rounded-x badge-red">2</span> &nbsp  Please wait for conversion after it finished upload</p>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="responsive-video md-margin-bottom-40" id="videoDisplay">

                </div>
            </div>
            <div class="col-md-6" id="form-video">
                <?php $form = ActiveForm::begin([
                    'id'=>'form-video-upload',
                    'action'=>Url::to(['/video/confirmed'])
                ])?>
                <?=$form->field($codeBankCampaign,'codeBank_code')->hiddenInput()->label(false)?>
                <?=$form->field($codeBankCampaign,'name')->hiddenInput()->label(false)?>
                <?=$form->field($codeBankCampaign,'modelClass')->hiddenInput()->label(false)?>
                <?=$form->field($codeBankCampaign,'startDate')->hiddenInput()->label(false)?>
                <?=$form->field($codeBankCampaign,'endDate')->hiddenInput()->label(false)?>

                <?= $form->field($model, 'title')->textInput(['maxlength' => true,'placeholder'=>'Video Title'])->label(false) ?>
                <?= $form->field($model, 'description')->textarea(['rows' => 6,'placeholder'=>'Video Description'])->label(false)?>
                <?= $form->field($model, 'size')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'duration')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'videoId')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'mobileLink')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'sdLink')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'hlsLink')->hiddenInput()->label(false) ?>
                <div class="form-group">
                    <?= Html::submitButton('Add Video', ['class' =>'btn btn-primary','id'=>'btn-upload']) ?>
                </div>

                <?php ActiveForm::end()?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="checkbox hidden">
                    <label>
                        <input type="checkbox" id="upgrade_to_1080" name="upgrade_to_1080" value="yes"> Upgrade to 1080 </input>
                    </label>
                </div>
                <div id="drop_zone">
                    <div class="sk-circle" id="circle">
                        <div class="sk-circle1 sk-child"></div>
                        <div class="sk-circle2 sk-child"></div>
                        <div class="sk-circle3 sk-child"></div>
                        <div class="sk-circle4 sk-child"></div>
                        <div class="sk-circle5 sk-child"></div>
                        <div class="sk-circle6 sk-child"></div>
                        <div class="sk-circle7 sk-child"></div>
                        <div class="sk-circle8 sk-child"></div>
                        <div class="sk-circle9 sk-child"></div>
                        <div class="sk-circle10 sk-child"></div>
                        <div class="sk-circle11 sk-child"></div>
                        <div class="sk-circle12 sk-child"></div>
                    </div>
                    <span id="drop_zone_text">Drop files here</span>
                </div>
                <br>
                <div class="progress" id="progressElement">
                    <div id="progress" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="46" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                        0%
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div id="action" class="hidden">
                    <button  class="btn btn-primary btn-default active" onclick="stopUpload();" id="stopUpload">Stop upload</button>
                </div>
            </div>
        </div>





    </div>
</div>

<?php $this->beginBlock('JavascriptInit');?>
<script>

    $('#circle').ready().hide();
    $('#videoDisplay').ready().hide();
    $('#form-video').ready().hide();

    var checkingInterval;

    document.body.addEventListener('UploadingCompleted',checkVideoAvailibility,false);



    function checkVideoAvailibility(e)
    {
        console.log("Preparing XMLHttpRequest...");
        var xhr = new XMLHttpRequest();
        var vimeoURL = 'https://api.vimeo.com/me/videos/' + e.detail;
        xhr.open('GET',vimeoURL , true);
        console.log("Send to " + vimeoURL);
        xhr.setRequestHeader('Authorization', 'Bearer ' + '98f69d517107b9c27ce654570eb1ac42');
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.responseType = 'json';
        xhr.onreadystatechange = function(){
            var status = xhr.status;
            if(status == 200){
                var responseFromVimeo = xhr.response;
                if(responseFromVimeo){
                    console.log("Good Data = " + responseFromVimeo);
                    console.log("Status = " + responseFromVimeo.status);
                    if(responseFromVimeo.status == 'available'){

                        $('#drop_zone_text').text(responseFromVimeo.status );
                        $('#circle').hide();
                        var files = responseFromVimeo.files;
                        console.log('Length: ' + files.length);
//                        $('#videoDisplay').show();
//                        $('#form-video').show();
//                        $('#videoDisplay').html(responseFromVimeo.embed.html);
//                        $('#drop_zone').hide();
                        //duration
                        $('#video-duration').val(responseFromVimeo.duration);

//                        files.forEach(function(obj){
//                            console.log('Quality:' + obj.quality);
//                            if(obj.quality === 'mobile')
//                            {
//                                $('#video-mobilelink').val(obj.link);
//                            }
//                            else if(obj.quality === 'hls')
//                            {
//                                $('#video-hlslink').val(obj.link);
//                            }
//                            else if(obj.quality === 'sd')
//                            {
//                                $('#video-sdlink').val(obj.link);
//                            }
//                        });
                        $('#btn-upload').delay(5000).trigger('click');

                    }
                    else
                    {
                        $('#circle').show();
                        console.log ("Current Status :" + responseFromVimeo.status);
                        $('#drop_zone_text').text(responseFromVimeo.status + ' in progress');
                        var completedUpload = new CustomEvent("UploadingCompleted",{
                            'detail': e.detail
                        });
                        document.body.dispatchEvent(completedUpload);


                    }
                }

            }
        };

        xhr.send();
    }


    /**
     * Called when files are dropped on to the drop target. For each file,
     * uploads the content to Drive & displays the results when complete.
     */
    function handleFileSelect(evt) {
        evt.stopPropagation();
        evt.preventDefault();


        var progress = document.getElementById('progressElement');
        progress.className = "progress";

        document.getElementById('action').className = 'action';

        var files = evt.dataTransfer.files; // FileList object.
        var accessToken = '98f69d517107b9c27ce654570eb1ac42';
        var upgrade_to_1080 = document.getElementById("upgrade_to_1080").value;

        // Clear the results div
//        var node = document.getElementById('results');
//        while (node.hasChildNodes()) node.removeChild(node.firstChild);
        // Rest the progress bar
        updateProgress(0);

        var uploader = new MediaUploader({
            file: files[0],
            token: accessToken,
            upgrade_to_1080: upgrade_to_1080,
            onError: function(data) {

                var errorResponse = JSON.parse(data);
                message = errorResponse.error;
               $('#drop_zone_text').text(message);

            },
            onProgress: function(data) {
                $('#drop_zone_text').text('upload in progress');
                updateProgress(data.loaded / data.total);

            },
            onComplete: function(videoId) {
                $('#video-videoid').val(videoId);
                var completedUpload = new CustomEvent("UploadingCompleted",{
                    'detail': videoId
                });
                document.body.dispatchEvent(completedUpload);
                var progress = document.getElementById('progressElement');
                progress.className = "progress hidden";
            }
        });
//        alert(uploader.file.size);
        var videoSize = uploader.file.size/1000000 ;
        $('#video-size').val(Math.round(videoSize.toFixed(2)));
        uploader.upload();

    }
    /**
     * Dragover handler to set the drop effect.
     */
    function handleDragOver(evt) {
        evt.stopPropagation();
        evt.preventDefault();
        evt.dataTransfer.dropEffect = 'copy';
    }
    /**
     * Wire up drag & drop listeners once page loads
     */
    document.addEventListener('DOMContentLoaded', function () {
        var dropZone = document.getElementById('drop_zone');
        dropZone.addEventListener('dragover', handleDragOver, false);
        dropZone.addEventListener('drop', handleFileSelect, false);
    });

    /**
     * Updat progress bar.
     */
    function updateProgress(progress) {
        var dropZone = document.getElementById('drop_zone');

        progress = Math.floor(progress * 100);
        var element = document.getElementById('progress');
        element.setAttribute('style', 'width:'+progress+'%');
        element.innerHTML = progress+'%';
        if(progress == 100)
        {
            document.getElementById('action').className = 'action hidden';
        }

    }

</script>


<?php $this->endBlock();?>
