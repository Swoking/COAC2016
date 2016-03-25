#ifndef MYADD_H
#define MYADD_H

#include "ui_myadd.h"

class COAC;
class Database;

class MyAdd : public QDialog, private Ui::MyAdd
{
protected:
    Database *db;
    COAC *fen;
    QFormLayout *myLayout;
    QDialogButtonBox *myButtonBox;

protected slots:
    virtual void envoyer() = 0;

public:
    MyAdd(COAC *parentFenetre, Database *database, QWidget *parent = 0);
};

#endif // MYADD_H
