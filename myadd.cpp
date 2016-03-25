#include "myadd.h"
#include <QDebug>

MyAdd::MyAdd(COAC *parentFenetre, Database *database, QWidget *parent) :
    QDialog(parent),
    db(database),
    fen(parentFenetre)
{
    setupUi(this);
    myLayout = this->formLayout;
    myButtonBox = this->buttonBox;

}
