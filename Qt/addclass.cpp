#include "addclass.h"

AddClass::AddClass(COAC *fen, QWidget *parent) :
    QDialog(parent),
    fenetre(fen)
{
    setupUi(this);
}
