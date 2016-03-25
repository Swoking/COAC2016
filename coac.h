#ifndef COAC_H
#define COAC_H

#include "ui_coac.h"
#include "camera.h"
#include "overlay.h"
#include "listeleve.h"
#include "listclasse.h"
#include "listsalle.h"
#include "listcarte.h"
#include "listlog.h"
#include "addcarte.h"
#include "addclasse.h"
#include "addlycee.h"
#include "addsalle.h"
#include "database.h"

class Database;
class Camera;
class ListEleve;
class ListClasse;
class ListSalle;
class ListCarte;
class ListLog;
class AddCarte;
class AddClasse;
class AddSalle;
class AddLycee;

class COAC : public QMainWindow, private Ui::COAC
{
    Q_OBJECT

private:
    enum Mode { Ajout, Edition };
    Mode mode;
    Database *db;
    Camera *camera;

    ListEleve *eleveList;
    ListClasse *classeList;
    ListSalle *salleList;
    ListCarte *carteList;
    ListLog *logList;
    AddCarte *carteAdd;
    AddClasse *classeAdd;
    AddSalle *salleAdd;
    AddLycee *lyceeAdd;

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

    void init();
    void setEleveInfo();
    void showCamera();
    void showOverlay();

private slots:
    void onPushActionListEleve(bool i);
    void onPushActionListClasse(bool i);
    void onPushActionListSalle(bool i);
    void onPushActionListCarte(bool i);
    void onPushActionListLog(bool i);
    void Envoyer(bool c);
    void imageCapture(bool);
    void displayViewfinder();
    void displayCapturedImage();
    void closeEvent(QCloseEvent *);
    void onPushActionAjouterCarte(bool i);
    void onPushActionAjouterClasse(bool i);
    void onPushActionAjouterSalle(bool i);
    void onPushActionAjouterLycee(bool i);


public:
    explicit COAC(Database *database, QWidget *parent = 0);

public slots:
    void onDoubleClickListEleve(QModelIndex);
    void mydebug();
};

#endif // COAC_H
