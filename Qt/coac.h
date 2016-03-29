#ifndef COAC_H
#define COAC_H

#include ".uic/ui_coac.h"
#include "database.h"
#include "camera.h"
#include "addcarte.h"
#include "addclass.h"
#include "elevelist.h"
#include <QImage>
#include <QCameraImageCapture>
#include <QMainWindow>

class Camera;
class EleveList;
class AddCarte;
class AddClass;
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
    AddCarte *addcarte;
    AddClass *addclasse;

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
    void onPushActionAddCarte(bool i);
    void onPushActionAddClasse(bool i);
    void Envoyer(bool);
    void imageCapture(bool);
    void displayViewfinder();
    void displayCapturedImage();
    void onDoubleClickListEleve(QModelIndex);
    void closeEvent(QCloseEvent *);
};

#endif // COAC_H
