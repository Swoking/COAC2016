#include "camera.h"
#include "coac.h"
#include <QActionGroup>
#include <QAction>

Camera::Camera(QObject* parent) :
    QObject(parent),
    my_camera(0),
    imageCapture(0),
    finishProcessCapture(false)
{
    checkCameraAvailability();

}


Camera::~Camera()
{

}

bool Camera::checkCameraAvailability()
{
    qDebug() << "Camera::checkCameraAvailability() > " << QCameraInfo::availableCameras().count() << "camera disponible.";
    if (QCameraInfo::availableCameras().count() > 0) {
        setCamera();
        return true;
    } else {
        return false;
    }
}

void Camera::setCamera()
{
    delete imageCapture;
    delete my_camera;

    QList<QCameraInfo> cameras = QCameraInfo::availableCameras();
    foreach (const QCameraInfo &cameraInfo, cameras) {
        qDebug() << "Camera::setCamera() > " << cameraInfo.deviceName();
        if (cameraInfo.deviceName() == "/dev/video0") {
            my_camera = new QCamera(cameraInfo);
            qDebug() << "Camera::setCamera() > " << cameraInfo.deviceName() << "selected.";
        }
    }

    imageCapture = new QCameraImageCapture(my_camera);

    connect(imageCapture, SIGNAL(imageCaptured(int,QImage)), this, SLOT(processCapturedImage(int,QImage)));

}

void Camera::processCapturedImage(int requestId, const QImage& img)
{
    Q_UNUSED(requestId);
    qDebug() << "Camera::processCapturedImage() > ";
    QImage scaledImage = img.scaled(viewfinder->size(),
                       Qt::KeepAspectRatio,
                       Qt::SmoothTransformation);
    image = scaledImage;

    finishProcessCapture = true;
    qDebug() << "Camera::processCapturedImage() > Capture terminée";
}

bool Camera::isFinishProcessCapture(){
    return finishProcessCapture;
}

void Camera::setFinishProcessCapture(bool state){
    finishProcessCapture = state;
}

void Camera::setViewfinder(QCameraViewfinder *tmpViewfinder){
    viewfinder = tmpViewfinder;
}
