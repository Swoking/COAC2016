#ifndef CAMERA_H
#define CAMERA_H

#include <QObject>
#include <QVideoWidget>
#include <QMediaPlayer>
#include <QCameraInfo>
#include <QCamera>
#include <QCameraViewfinder>
#include <QCameraImageCapture>
#include <QObject>

//class QVideoWidget;

class Camera : public QObject
{
    Q_OBJECT

public:
    Camera(QObject* parent = 0);
    ~Camera();
    bool checkCameraAvailability();
    void setCamera();
    bool isFinishProcessCapture();
    void setFinishProcessCapture(bool);
    QCamera *my_camera;
    QImage image;
    QCameraImageCapture *imageCapture;

public slots:
    void processCapturedImage(int requestId, const QImage &img);

private:
    QCameraViewfinder *viewfinder;
    bool finishProcessCapture;

};

#endif // CAMERA_H
