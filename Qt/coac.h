#ifndef COAC_H
#define COAC_H

#include "ui_coac.h"
#include "database.h"
#include "camera.h"
#include "elevelist.h"
#include <QImage>
#include <QCameraImageCapture>

class Camera;
class EleveList;
class Database;

class COAC : public QMainWindow, private Ui::COAC
{
    Q_OBJECT

public:
    enum Mode { Ajout, Edition };
    explicit COAC(QWidget *parent = 0);
    void printPromos();
    void printDateNaissance();
    void showCamera();
    void setEleveInfo();

private:
    Camera *camera;
    //QImage image;
    Mode mode;
    EleveList *elevelist;

    int     id;
    QString nom;
    QString prenom;
    int     idPromo;
    QString adresse;
    QString ville;
    QString cp;
    QString mail;
    QString sex;
    QString date;

public slots:
    void onPushActionEleve(bool i);
    void Envoyer(bool);
    void imageCapture(bool);
    void displayViewfinder();
    void displayCapturedImage();
    void onDoubleClickListEleve(QModelIndex);
};

#endif // COAC_H
